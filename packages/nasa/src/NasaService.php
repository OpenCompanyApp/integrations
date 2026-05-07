<?php

namespace OpenCompany\Integrations\Nasa;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for NASA public APIs.
 *
 * Handles api.nasa.gov key-based endpoints plus public Image Library and EONET hosts.
 */
class NasaService
{
    /**
     * Create a new NasaService instance.
     *
     * @param  string  $apiKey  NASA API key (defaults to DEMO_KEY for public access).
     * @param  string  $baseUrl  Base URL for the NASA API (defaults to https://api.nasa.gov).
     * @param  string  $imageBaseUrl  Base URL for the NASA Image and Video Library API.
     * @param  string  $eonetBaseUrl  Base URL for the EONET v3 API.
     */
    public function __construct(
        private string $apiKey = 'DEMO_KEY',
        private string $baseUrl = 'https://api.nasa.gov',
        private string $imageBaseUrl = 'https://images-api.nasa.gov',
        private string $eonetBaseUrl = 'https://eonet.gsfc.nasa.gov/api/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->imageBaseUrl = rtrim($this->imageBaseUrl, '/');
        $this->eonetBaseUrl = rtrim($this->eonetBaseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the Astronomy Picture of the Day (APOD).
     *
     * @param  string|null  $date  A specific date in YYYY-MM-DD format (defaults to today).
     * @param  string|null  $startDate  Start date for a date range in YYYY-MM-DD format.
     * @param  string|null  $endDate  End date for a date range in YYYY-MM-DD format.
     * @param  int|null  $count  Number of random entries to return.
     * @param  bool|null  $thumbs  Whether video thumbnails should be returned.
     * @return array<string, mixed>|array<int, array<string, mixed>> A single APOD entry or a list when using date ranges.
     */
    public function getApod(
        ?string $date = null,
        ?string $startDate = null,
        ?string $endDate = null,
        ?int $count = null,
        ?bool $thumbs = null,
    ): array
    {
        $params = [];
        if ($date !== null) {
            $params['date'] = $date;
        }
        if ($startDate !== null) {
            $params['start_date'] = $startDate;
        }
        if ($endDate !== null) {
            $params['end_date'] = $endDate;
        }
        if ($count !== null) {
            $params['count'] = $count;
        }
        if ($thumbs !== null) {
            $params['thumbs'] = $thumbs ? 'true' : 'false';
        }

        return $this->request('GET', '/planetary/apod', $params);
    }

    /**
     * Get Mars Rover Photos.
     *
     * @param  string  $rover  The rover name: "curiosity", "opportunity", "spirit", or "perseverance".
     * @param  int|null  $sol  The sol (Martian day) number.
     * @param  string|null  $earthDate  Earth date in YYYY-MM-DD format.
     * @param  string|null  $camera  Camera abbreviation: FHAZ, RHAZ, MAST, CHEMCAM, MAHLI, MARDI, NAVCAM, PANCAM, MINITES, ENTRY, HAZCAM, SKYCAM, SHERLOCWATSON, SUPERCAM, MCZ_LEFT, MCZ_RIGHT, FRONT_HAZCAM_LEFT_A, FRONT_HAZCAM_RIGHT_A, REAR_HAZCAM_LEFT, REAR_HAZCAM_RIGHT.
     * @param  int|null  $page  Page number for pagination (default 1).
     * @return array<string, mixed> The photos response.
     */
    public function getMarsRoverPhotos(string $rover, ?int $sol = null, ?string $earthDate = null, ?string $camera = null, ?int $page = null): array
    {
        $params = [];
        if ($sol !== null) {
            $params['sol'] = $sol;
        }
        if ($earthDate !== null) {
            $params['earth_date'] = $earthDate;
        }
        if ($camera !== null) {
            $params['camera'] = $camera;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/mars-photos/api/v1/rovers/' . rawurlencode($rover) . '/photos', $params);
    }

    /**
     * Get a feed of Near Earth Objects (asteroids) for a date range.
     *
     * @param  string|null  $startDate  Start date in YYYY-MM-DD format (defaults to today).
     * @param  string|null  $endDate  End date in YYYY-MM-DD format (max 7 days after start_date).
     * @return array<string, mixed> The asteroid feed response.
     */
    public function getAsteroids(?string $startDate = null, ?string $endDate = null): array
    {
        $params = [];
        if ($startDate !== null) {
            $params['start_date'] = $startDate;
        }
        if ($endDate !== null) {
            $params['end_date'] = $endDate;
        }

        return $this->request('GET', '/neo/rest/v1/feed', $params);
    }

    /**
     * Get details for a specific Near Earth Object (asteroid) by its ID.
     *
     * @param  string  $id  The asteroid's unique NASA ID (e.g., "2534304").
     * @return array<string, mixed> The asteroid details.
     */
    public function getAsteroid(string $id): array
    {
        return $this->request('GET', '/neo/rest/v1/neo/' . rawurlencode($id));
    }

    /**
     * Browse the overall Near Earth Object dataset.
     *
     * @param  int|null  $page  Page number.
     * @param  int|null  $size  Page size.
     * @return array<string, mixed>
     */
    public function browseAsteroids(?int $page = null, ?int $size = null): array
    {
        return $this->request('GET', '/neo/rest/v1/neo/browse', array_filter([
            'page' => $page,
            'size' => $size,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Search the NASA Image and Video Library.
     *
     * @param  string  $q  The search query string.
     * @param  string|null  $mediaType  Filter by media type: "image", "video", or "audio".
     * @param  int|null  $page  Page number (default 1).
     * @param  array<string, mixed>  $filters  Additional Image Library search filters.
     * @return array<string, mixed> The search results.
     */
    public function searchImages(string $q, ?string $mediaType = null, ?int $page = null, array $filters = []): array
    {
        $params = array_filter(array_merge($filters, ['q' => $q]), static fn (mixed $value): bool => $value !== null && $value !== '');
        if ($mediaType !== null) {
            $params['media_type'] = $mediaType;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->requestExternal('GET', $this->imageBaseUrl . '/search', $params);
    }

    /**
     * Get asset manifests from the NASA Image and Video Library.
     *
     * @param  string  $nasaId  NASA media asset ID.
     * @return array<string, mixed>
     */
    public function getImageAsset(string $nasaId): array
    {
        return $this->requestExternal('GET', $this->imageBaseUrl . '/asset/' . rawurlencode($nasaId));
    }

    /**
     * Get metadata from the NASA Image and Video Library.
     *
     * @param  string  $nasaId  NASA media asset ID.
     * @return array<string, mixed>
     */
    public function getImageMetadata(string $nasaId): array
    {
        return $this->requestExternal('GET', $this->imageBaseUrl . '/metadata/' . rawurlencode($nasaId));
    }

    /**
     * Get caption locations from the NASA Image and Video Library.
     *
     * @param  string  $nasaId  NASA media asset ID.
     * @return array<string, mixed>
     */
    public function getImageCaptions(string $nasaId): array
    {
        return $this->requestExternal('GET', $this->imageBaseUrl . '/captions/' . rawurlencode($nasaId));
    }

    /**
     * Query DONKI space-weather event endpoints.
     *
     * @param  string  $type  DONKI endpoint, such as CME, CMEAnalysis, GST, IPS, FLR, SEP, MPC, RBE, HSS, WSAEnlilSimulations, or notifications.
     * @param  array<string, mixed>  $params  DONKI query parameters.
     * @return array<string, mixed>
     */
    public function getDonkiEvents(string $type, array $params = []): array
    {
        $allowed = [
            'cme' => 'CME',
            'cmeanalysis' => 'CMEAnalysis',
            'gst' => 'GST',
            'ips' => 'IPS',
            'flr' => 'FLR',
            'sep' => 'SEP',
            'mpc' => 'MPC',
            'rbe' => 'RBE',
            'hss' => 'HSS',
            'wsaenlilsimulations' => 'WSAEnlilSimulations',
            'notifications' => 'notifications',
        ];
        $normalized = $allowed[strtolower($type)] ?? null;

        if ($normalized === null) {
            throw new RuntimeException('Unsupported DONKI event type.');
        }

        return $this->request('GET', '/DONKI/' . $normalized, $params);
    }

    /**
     * Get EPIC image metadata.
     *
     * @param  string  $collection  EPIC collection such as natural or enhanced.
     * @param  string|null  $date  Optional date in YYYY-MM-DD format.
     * @param  bool  $allDates  Return all available dates instead of image metadata.
     * @return array<string, mixed>
     */
    public function getEpicImages(string $collection = 'natural', ?string $date = null, bool $allDates = false): array
    {
        if (! in_array($collection, ['natural', 'enhanced'], true)) {
            throw new RuntimeException('Unsupported EPIC collection. Use natural or enhanced.');
        }

        $path = '/EPIC/api/' . rawurlencode($collection);
        if ($allDates) {
            $path .= '/all';
        } elseif ($date !== null) {
            $path .= '/date/' . rawurlencode($date);
        } else {
            $path .= '/images';
        }

        return $this->request('GET', $path);
    }

    /**
     * List EPIC available dates for a collection.
     *
     * @param  string  $collection  EPIC collection such as natural or enhanced.
     * @return array<string, mixed>
     */
    public function getEpicAvailableDates(string $collection = 'natural'): array
    {
        return $this->getEpicImages($collection, allDates: true);
    }

    /**
     * Get Landsat Earth imagery for a coordinate and date.
     *
     * @param  array<string, mixed>  $params  Earth imagery query parameters.
     * @return array<string, mixed>
     */
    public function getEarthImagery(array $params): array
    {
        $response = $this->rawRequest('GET', '/planetary/earth/imagery', $params);
        $contentType = (string) $response->header('Content-Type');

        if (str_contains($contentType, 'application/json')) {
            return $response->json() ?? [];
        }

        return [
            'content_type' => $contentType,
            'size_bytes' => strlen($response->body()),
            'note' => 'NASA returned binary image content. Use the same parameters against the Earth imagery endpoint to fetch the image file.',
        ];
    }

    /**
     * Get available Landsat asset dates for a coordinate.
     *
     * @param  array<string, mixed>  $params  Earth assets query parameters.
     * @return array<string, mixed>
     */
    public function getEarthAssets(array $params): array
    {
        return $this->request('GET', '/planetary/earth/assets', $params);
    }

    /**
     * List EONET v3 natural events.
     *
     * @param  array<string, mixed>  $params  EONET event query parameters.
     * @return array<string, mixed>
     */
    public function getEonetEvents(array $params = []): array
    {
        return $this->requestExternal('GET', $this->eonetBaseUrl . '/events', $params);
    }

    /**
     * Get one EONET v3 natural event.
     *
     * @param  string  $id  EONET event ID.
     * @return array<string, mixed>
     */
    public function getEonetEvent(string $id): array
    {
        return $this->requestExternal('GET', $this->eonetBaseUrl . '/events/' . rawurlencode($id));
    }

    /**
     * List EONET v3 event categories.
     *
     * @return array<string, mixed>
     */
    public function getEonetCategories(): array
    {
        return $this->requestExternal('GET', $this->eonetBaseUrl . '/categories');
    }

    /**
     * List EONET v3 event sources.
     *
     * @return array<string, mixed>
     */
    public function getEonetSources(): array
    {
        return $this->requestExternal('GET', $this->eonetBaseUrl . '/sources');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed> Parsed JSON response body.
     */
    private function request(string $method, string $path, array $params = []): array
    {
        $response = $this->rawRequest($method, $path, $params);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the NASA API.
     *
     * Appends the api_key query parameter to every request for authentication.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $params = []): Response
    {
        if (! $this->apiKey) {
            throw new RuntimeException('NASA API key is not configured.');
        }

        $url = $this->baseUrl . $path;
        $params['api_key'] = $this->apiKey;

        try {
            $http = Http::timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $json = $response->json();
                $error = $json['error']['message'] ?? $json['msg'] ?? $response->body();

                Log::error("NASA API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("NASA API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("NASA API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to NASA API: {$e->getMessage()}");
        }
    }

    /**
     * Make an unauthenticated request to a NASA-hosted external API.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    private function requestExternal(string $method, string $url, array $params = []): array
    {
        try {
            $http = Http::timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('reason') ?? $response->json('message') ?? $response->body();
                Log::error("NASA external API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("NASA external API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error("NASA external API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to NASA external API: {$e->getMessage()}");
        }
    }
}
