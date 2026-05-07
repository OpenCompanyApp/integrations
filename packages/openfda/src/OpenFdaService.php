<?php

namespace OpenCompany\Integrations\OpenFda;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the openFDA public API.
 *
 * Handles dataset endpoint routing, query normalization, optional API keys,
 * response parsing, and openFDA error conversion.
 */
class OpenFdaService
{
    /**
     * @param  string  $baseUrl  openFDA API base URL.
     */
    public function __construct(
        private string $baseUrl = 'https://api.fda.gov',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Query an openFDA dataset endpoint.
     *
     * @param  array<string, mixed>  $query  openFDA query parameters such as search, count, sort, limit, skip, and api_key.
     * @return array<string, mixed>
     */
    public function query(string $endpoint, array $query = []): array
    {
        $endpoint = trim($endpoint, '/');
        if ($endpoint === '') {
            throw new RuntimeException('endpoint is required.');
        }

        try {
            $response = Http::acceptJson()
                ->withUserAgent('OpenCompany Integrations openfda/1.0 (mailto:agent@example.test)')
                ->timeout(60)
                ->get($this->urlWithQuery($this->baseUrl.'/'.$endpoint.'.json', $query));

            return $this->parseResponse($response, $endpoint);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("openFDA API connection error: {$endpoint}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to openFDA API: {$e->getMessage()}");
        }
    }

    /**
     * Build a URL with encoded query parameters.
     *
     * @param  array<string, mixed>  $query  Raw query parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $normalized = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_array($value)) {
                $value = implode(',', array_map(static fn (mixed $item): string => (string) $item, array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== '')));
            }

            if ($value !== '') {
                $normalized[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
            }
        }

        return $normalized === [] ? $url : $url.'?'.http_build_query($normalized, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * Parse openFDA JSON responses and normalize API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $endpoint): array
    {
        $json = $response->json();

        if (!$response->successful()) {
            $message = $this->errorMessage($json) ?? $response->body();
            Log::error("openFDA API error: {$endpoint}", ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('openFDA API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            $message = $this->errorMessage($json);
            if ($message !== null) {
                throw new RuntimeException('openFDA API error ('.$response->status().'): '.$message);
            }

            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Extract a readable openFDA error message from JSON responses.
     */
    private function errorMessage(mixed $json): ?string
    {
        if (!is_array($json)) {
            return null;
        }

        $error = $json['error'] ?? null;
        if (is_array($error)) {
            return (string) ($error['message'] ?? $error['code'] ?? 'Unknown openFDA error.');
        }

        return is_string($error) ? $error : null;
    }
}
