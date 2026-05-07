<?php

namespace OpenCompany\Integrations\OpenMeteo;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the public Open-Meteo APIs.
 *
 * Encapsulates endpoint routing, query encoding, response parsing, and
 * Open-Meteo error normalization for all tool classes.
 */
class OpenMeteoService
{
    /** @var array<string, string> */
    private array $endpoints = [
        'forecast' => 'https://api.open-meteo.com/v1/forecast',
        'archive' => 'https://archive-api.open-meteo.com/v1/archive',
        'historical_forecast' => 'https://historical-forecast-api.open-meteo.com/v1/forecast',
        'model_forecast' => 'https://api.open-meteo.com/v1/{model}',
        'ensemble' => 'https://ensemble-api.open-meteo.com/v1/ensemble',
        'seasonal' => 'https://seasonal-api.open-meteo.com/v1/seasonal',
        'climate' => 'https://climate-api.open-meteo.com/v1/climate',
        'marine' => 'https://marine-api.open-meteo.com/v1/marine',
        'air_quality' => 'https://air-quality-api.open-meteo.com/v1/air-quality',
        'satellite_radiation' => 'https://satellite-api.open-meteo.com/v1/satellite-radiation',
        'flood' => 'https://flood-api.open-meteo.com/v1/flood',
        'elevation' => 'https://api.open-meteo.com/v1/elevation',
        'geocoding_search' => 'https://geocoding-api.open-meteo.com/v1/search',
        'geocoding_get' => 'https://geocoding-api.open-meteo.com/v1/get',
    ];

    /**
     * @param  string  $apiKey  Optional Open-Meteo commercial API key.
     * @param  array<string, string>  $endpointOverrides  Optional endpoint URL overrides for self-hosted or customer hosts.
     */
    public function __construct(private string $apiKey = '', array $endpointOverrides = [])
    {
        foreach ($endpointOverrides as $key => $url) {
            if (isset($this->endpoints[$key]) && $url !== '') {
                $this->endpoints[$key] = rtrim($url, '/');
            }
        }
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Execute an Open-Meteo endpoint.
     *
     * @param  array<string, mixed>  $query  Query parameters for the endpoint.
     * @return array<string, mixed>
     */
    public function get(string $endpoint, array $query = []): array
    {
        $url = $this->endpointUrl($endpoint, $query);
        unset($query['model_endpoint']);

        if ($this->apiKey !== '' && !array_key_exists('apikey', $query)) {
            $query['apikey'] = $this->apiKey;
        }

        try {
            $response = Http::acceptJson()->timeout(60)->get($this->urlWithQuery($url, $query));

            return $this->parseResponse($response, $endpoint);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Open-Meteo API connection error: {$endpoint}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to Open-Meteo API: {$e->getMessage()}");
        }
    }

    /**
     * Resolve the concrete endpoint URL.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function endpointUrl(string $endpoint, array $query): string
    {
        if (!isset($this->endpoints[$endpoint])) {
            throw new RuntimeException("Unsupported Open-Meteo endpoint: {$endpoint}");
        }

        $url = $this->endpoints[$endpoint];
        if ($endpoint === 'model_forecast') {
            $model = $query['model_endpoint'] ?? null;
            if (!is_string($model) || trim($model) === '') {
                throw new RuntimeException('model_endpoint must be a non-empty string for model forecasts.');
            }

            $url = str_replace('{model}', rawurlencode($model), $url);
        }

        return $url;
    }

    /**
     * Parse Open-Meteo JSON responses and raise normalized API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $endpoint): array
    {
        $json = $response->json();
        if (!$response->successful() || (is_array($json) && ($json['error'] ?? false) === true)) {
            $reason = is_array($json) ? ($json['reason'] ?? $json['error'] ?? null) : null;
            $error = is_string($reason) ? $reason : $response->body();
            Log::error("Open-Meteo API error: {$endpoint}", ['status' => $response->status(), 'error' => $error]);

            throw new RuntimeException('Open-Meteo API error ('.$response->status().'): '.$error);
        }

        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Append query parameters, using Open-Meteo comma lists for array values.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $encodedValue = is_array($value)
                ? implode(',', array_map(static fn (mixed $item): string => (string) $item, array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== '')))
                : (string) $value;

            if ($encodedValue !== '') {
                $parts[] = rawurlencode((string) $key).'='.rawurlencode($encodedValue);
            }
        }

        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}
