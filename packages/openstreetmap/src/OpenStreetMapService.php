<?php

namespace OpenCompany\Integrations\OpenStreetMap;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for public OpenStreetMap-related APIs.
 *
 * Handles Nominatim geocoding, Overpass API queries, response parsing, user
 * agent headers, validation, and stable OpenStreetMap URL construction.
 */
class OpenStreetMapService
{
    /**
     * @param  string  $nominatimUrl  Nominatim API base URL.
     * @param  string  $overpassUrl  Overpass API base URL.
     * @param  string  $osmBaseUrl  OpenStreetMap website base URL.
     */
    public function __construct(
        private string $nominatimUrl = 'https://nominatim.openstreetmap.org',
        private string $overpassUrl = 'https://overpass-api.de/api',
        private string $osmBaseUrl = 'https://www.openstreetmap.org',
    ) {
        $this->nominatimUrl = rtrim($this->nominatimUrl, '/');
        $this->overpassUrl = rtrim($this->overpassUrl, '/');
        $this->osmBaseUrl = rtrim($this->osmBaseUrl, '/');
    }

    /**
     * Search for locations with Nominatim.
     *
     * @param  array<string, mixed>  $params  Free-form or structured address query, output, details, language, restriction, polygon, and email options.
     * @return array<string, mixed>
     */
    public function nominatimSearch(array $params): array
    {
        if (($params['q'] ?? '') === '' && !$this->hasStructuredAddress($params)) {
            throw new RuntimeException('q or at least one structured address field is required for Nominatim search.');
        }

        return $this->nominatimGet('search', $params + ['format' => 'jsonv2']);
    }

    /**
     * Reverse geocode latitude and longitude with Nominatim.
     *
     * @param  array<string, mixed>  $params  lat, lon, output, details, language, layer, zoom, polygon, and email options.
     * @return array<string, mixed>
     */
    public function nominatimReverse(array $params): array
    {
        return $this->nominatimGet('reverse', $params + ['format' => 'jsonv2'], ['lat', 'lon']);
    }

    /**
     * Look up Nominatim address details by OSM object IDs.
     *
     * @param  array<string, mixed>  $params  Comma-separated osm_ids or OSM-prefixed IDs plus output detail options.
     * @return array<string, mixed>
     */
    public function nominatimLookup(array $params): array
    {
        return $this->nominatimGet('lookup', $params + ['format' => 'jsonv2'], ['osm_ids']);
    }

    /**
     * Get Nominatim place details by place_id or OSM object reference.
     *
     * @param  array<string, mixed>  $params  place_id or osmtype/osmid plus class, address, hierarchy, keywords, linkedplaces, polygon, and language options.
     * @return array<string, mixed>
     */
    public function nominatimDetails(array $params): array
    {
        if (($params['place_id'] ?? '') === '' && (($params['osmtype'] ?? '') === '' || ($params['osmid'] ?? '') === '')) {
            throw new RuntimeException('place_id or both osmtype and osmid are required for Nominatim details.');
        }

        return $this->nominatimGet('details', $params + ['format' => 'json']);
    }

    /**
     * Get Nominatim service status.
     *
     * @param  array<string, mixed>  $params  Optional output format.
     * @return array<string, mixed>
     */
    public function nominatimStatus(array $params = []): array
    {
        return $this->nominatimGet('status', $params + ['format' => 'json']);
    }

    /**
     * Execute an Overpass QL query.
     *
     * @param  array<string, mixed>  $params  Overpass QL query and optional request method.
     * @return array<string, mixed>
     */
    public function overpassQuery(array $params): array
    {
        $query = (string) ($params['query'] ?? '');
        if (trim($query) === '') {
            throw new RuntimeException('query is required for Overpass query.');
        }

        $method = strtolower((string) ($params['method'] ?? 'post'));
        if (!in_array($method, ['get', 'post'], true)) {
            throw new RuntimeException('method must be get or post.');
        }

        return $method === 'get'
            ? $this->overpassGet('interpreter', ['data' => $query])
            : $this->overpassPost('interpreter', ['data' => $query]);
    }

    /**
     * Get Overpass API status.
     *
     * @param  array<string, mixed>  $params  No parameters.
     * @return array<string, mixed>
     */
    public function overpassStatus(array $params = []): array
    {
        return $this->overpassGet('status', $params);
    }

    /**
     * Build a stable OpenStreetMap object URL.
     *
     * @param  array<string, mixed>  $params  OSM object type and ID.
     * @return array<string, mixed>
     */
    public function objectUrl(array $params): array
    {
        $type = $this->objectType((string) ($params['type'] ?? ''));
        $id = $this->positiveId((string) ($params['id'] ?? ''));

        return ['url' => $this->osmBaseUrl.'/'.$type.'/'.$id, 'type' => $type, 'id' => $id];
    }

    /**
     * Build a stable OpenStreetMap map URL.
     *
     * @param  array<string, mixed>  $params  Latitude, longitude, and optional zoom.
     * @return array<string, mixed>
     */
    public function mapUrl(array $params): array
    {
        foreach (['lat', 'lon'] as $field) {
            if (!array_key_exists($field, $params) || trim((string) $params[$field]) === '') {
                throw new RuntimeException($field.' is required for map URL.');
            }
        }

        $zoom = (int) ($params['zoom'] ?? 18);

        return ['url' => $this->osmBaseUrl.'/?mlat='.$params['lat'].'&mlon='.$params['lon'].'#map='.$zoom.'/'.$params['lat'].'/'.$params['lon'], 'lat' => $params['lat'], 'lon' => $params['lon'], 'zoom' => $zoom];
    }

    /**
     * Execute a Nominatim GET request.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @param  list<string>  $required  Required parameter names.
     * @return array<string, mixed>
     */
    private function nominatimGet(string $path, array $params = [], array $required = []): array
    {
        $this->validateRequired($path, $params, $required);

        try {
            $response = Http::acceptJson()
                ->withHeaders($this->headers())
                ->timeout(60)
                ->get($this->nominatimUrl.'/'.$path, $this->query($params));

            return $this->parseResponse($response, 'Nominatim', $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Nominatim connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Nominatim: '.$e->getMessage());
        }
    }

    /**
     * Execute an Overpass GET request.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    private function overpassGet(string $path, array $params = []): array
    {
        try {
            $response = Http::acceptJson()
                ->withHeaders($this->headers())
                ->timeout(90)
                ->get($this->overpassUrl.'/'.$path, $this->query($params));

            return $this->parseResponse($response, 'Overpass API', $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Overpass API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Overpass API: '.$e->getMessage());
        }
    }

    /**
     * Execute an Overpass POST request.
     *
     * @param  array<string, mixed>  $params  Form parameters.
     * @return array<string, mixed>
     */
    private function overpassPost(string $path, array $params = []): array
    {
        try {
            $response = Http::acceptJson()
                ->asForm()
                ->withHeaders($this->headers())
                ->timeout(90)
                ->post($this->overpassUrl.'/'.$path, $this->query($params));

            return $this->parseResponse($response, 'Overpass API', $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Overpass API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Overpass API: '.$e->getMessage());
        }
    }

    /**
     * Validate required request fields.
     *
     * @param  array<string, mixed>  $params  Request parameters.
     * @param  list<string>  $required  Required field names.
     */
    private function validateRequired(string $path, array $params, array $required): void
    {
        foreach ($required as $field) {
            if (!array_key_exists($field, $params) || $params[$field] === null || $params[$field] === '') {
                throw new RuntimeException($field.' is required for '.$path.'.');
            }
        }
    }

    /**
     * Normalize query values for HTTP requests.
     *
     * @param  array<string, mixed>  $params  Request parameters.
     * @return array<string, mixed>
     */
    private function query(array $params): array
    {
        $query = [];
        foreach ($params as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            $query[$key] = is_bool($value) ? ($value ? 1 : 0) : $value;
        }

        return $query;
    }

    /**
     * Check whether structured address fields are present.
     *
     * @param  array<string, mixed>  $params  Search parameters.
     */
    private function hasStructuredAddress(array $params): bool
    {
        foreach (['street', 'city', 'county', 'state', 'country', 'postalcode'] as $field) {
            if (($params[$field] ?? '') !== '') {
                return true;
            }
        }

        return false;
    }

    /**
     * Build public API headers.
     *
     * @return array<string, string>
     */
    private function headers(): array
    {
        return ['User-Agent' => 'OpenCompany Integrations/1.0 (https://opencompany.ai; integrations@opencompany.ai)'];
    }

    /**
     * Parse JSON or text responses and normalize errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $service, string $path): array
    {
        $json = $response->json();
        if (!$response->successful()) {
            $message = is_array($json) ? (string) ($json['error'] ?? $json['message'] ?? '') : trim(strip_tags($response->body()));
            Log::error($service.' error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException($service.' error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Validate and normalize an OSM object type.
     */
    private function objectType(string $type): string
    {
        $type = strtolower(trim($type));
        if (!in_array($type, ['node', 'way', 'relation'], true)) {
            throw new RuntimeException('type must be node, way, or relation.');
        }

        return $type;
    }

    /**
     * Validate and normalize a positive OSM object ID.
     */
    private function positiveId(string $id): string
    {
        if (!preg_match('/^[1-9][0-9]*$/', trim($id))) {
            throw new RuntimeException('id must be a positive OpenStreetMap object ID.');
        }

        return trim($id);
    }
}
