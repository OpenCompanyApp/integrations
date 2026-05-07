<?php

namespace OpenCompany\Integrations\OpenWeather;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the OpenWeather APIs.
 *
 * Handles API-key injection, endpoint routing, query encoding, response parsing,
 * and OpenWeather error normalization.
 */
class OpenWeatherService
{
    /** @var array<string, string> */
    private array $endpoints = [
        'current_weather' => 'https://api.openweathermap.org/data/2.5/weather',
        'forecast_5_day' => 'https://api.openweathermap.org/data/2.5/forecast',
        'one_call' => 'https://api.openweathermap.org/data/3.0/onecall',
        'one_call_timemachine' => 'https://api.openweathermap.org/data/3.0/onecall/timemachine',
        'one_call_day_summary' => 'https://api.openweathermap.org/data/3.0/onecall/day_summary',
        'one_call_overview' => 'https://api.openweathermap.org/data/3.0/onecall/overview',
        'air_pollution' => 'https://api.openweathermap.org/data/2.5/air_pollution',
        'air_pollution_forecast' => 'https://api.openweathermap.org/data/2.5/air_pollution/forecast',
        'air_pollution_history' => 'https://api.openweathermap.org/data/2.5/air_pollution/history',
        'geocoding_direct' => 'https://api.openweathermap.org/geo/1.0/direct',
        'geocoding_reverse' => 'https://api.openweathermap.org/geo/1.0/reverse',
        'geocoding_zip' => 'https://api.openweathermap.org/geo/1.0/zip',
    ];

    /**
     * @param  string  $apiKey  OpenWeather API key.
     * @param  array<string, string>  $endpointOverrides  Optional endpoint URL overrides.
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
        return $this->apiKey !== '';
    }

    /**
     * Execute an OpenWeather endpoint.
     *
     * @param  array<string, mixed>  $query  Query parameters for the endpoint.
     * @return array<string, mixed>
     */
    public function get(string $endpoint, array $query = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('OpenWeather API key is not configured.');
        }
        if (!isset($this->endpoints[$endpoint])) {
            throw new RuntimeException("Unsupported OpenWeather endpoint: {$endpoint}");
        }

        $query['appid'] ??= $this->apiKey;

        try {
            $response = Http::acceptJson()->timeout(60)->get($this->urlWithQuery($this->endpoints[$endpoint], $query));

            return $this->parseResponse($response, $endpoint);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OpenWeather API connection error: {$endpoint}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to OpenWeather API: {$e->getMessage()}");
        }
    }

    /**
     * Parse OpenWeather JSON responses and raise normalized errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $endpoint): array
    {
        $json = $response->json();
        $cod = is_array($json) ? ($json['cod'] ?? null) : null;
        $isErrorCod = is_scalar($cod) && !in_array((string) $cod, ['200', '0'], true);

        if (!$response->successful() || $isErrorCod) {
            $message = is_array($json) ? ($json['message'] ?? $json['error'] ?? null) : null;
            $error = is_string($message) ? $message : $response->body();
            Log::error("OpenWeather API error: {$endpoint}", ['status' => $response->status(), 'error' => $error]);

            throw new RuntimeException('OpenWeather API error ('.$response->status().'): '.$error);
        }

        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Append query parameters using comma-separated arrays where OpenWeather expects lists.
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
