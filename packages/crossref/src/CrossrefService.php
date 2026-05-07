<?php

namespace OpenCompany\Integrations\Crossref;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the public Crossref REST API.
 *
 * Handles endpoint routing, Crossref query normalization, JSON parsing, and
 * error conversion for scholarly metadata endpoints.
 */
class CrossrefService
{
    /**
     * @param  string  $baseUrl  Crossref API base URL.
     */
    public function __construct(private string $baseUrl = 'https://api.crossref.org')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Make a GET request to Crossref.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function get(string $path, array $query = []): array
    {
        try {
            $response = Http::acceptJson()
                ->withUserAgent('OpenCompany Integrations crossref/1.0')
                ->timeout(60)
                ->get($this->baseUrl.'/'.ltrim($path, '/'), $this->normalizeQuery($query));

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Crossref API connection error: {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to Crossref API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize Crossref query arrays into comma-separated filter/list syntax.
     *
     * @param  array<string, mixed>  $query  Raw query parameters.
     * @return array<string, scalar>
     */
    private function normalizeQuery(array $query): array
    {
        $normalized = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_array($value)) {
                $value = $this->stringifyArray($value);
            }

            if ($value !== '') {
                $normalized[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
            }
        }

        return $normalized;
    }

    /**
     * Convert array query values to Crossref's comma-separated format.
     *
     * @param  array<mixed>  $value  Query array value.
     */
    private function stringifyArray(array $value): string
    {
        $isAssoc = array_keys($value) !== range(0, count($value) - 1);
        if ($isAssoc) {
            return implode(',', array_map(
                static fn (string|int $key, mixed $item): string => (string) $key.':'.(is_bool($item) ? ($item ? 'true' : 'false') : (string) $item),
                array_keys($value),
                $value
            ));
        }

        return implode(',', array_map(static fn (mixed $item): string => (string) $item, array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== '')));
    }

    /**
     * Parse JSON responses and convert Crossref errors to exceptions.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();
        $status = is_array($json) ? ($json['status'] ?? null) : null;
        if (!$response->successful() || $status === 'failed' || $status === 'error') {
            $message = is_array($json) ? ($json['message'] ?? null) : null;
            $error = is_string($message) ? $message : $response->body();
            Log::error("Crossref API error: {$path}", ['status' => $response->status(), 'error' => $error]);

            throw new RuntimeException('Crossref API error ('.$response->status().'): '.$error);
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }
}
