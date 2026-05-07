<?php

namespace OpenCompany\Integrations\DataCite;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the public DataCite APIs.
 *
 * Handles REST and GraphQL requests, JSON:API query normalization, response
 * parsing, and DataCite error conversion.
 */
class DataCiteService
{
    /**
     * @param  string  $baseUrl  DataCite REST API base URL.
     * @param  string  $graphqlUrl  DataCite GraphQL endpoint URL.
     */
    public function __construct(
        private string $baseUrl = 'https://api.datacite.org',
        private string $graphqlUrl = 'https://api.datacite.org/graphql',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Make a GET request to a DataCite REST endpoint.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function get(string $path, array $query = []): array
    {
        try {
            $response = Http::accept('application/vnd.api+json, application/json')
                ->withUserAgent('OpenCompany Integrations datacite/1.0 (mailto:agent@example.test)')
                ->timeout(60)
                ->get($this->baseUrl.'/'.ltrim($path, '/'), $this->normalizeQuery($query));

            return $this->parseResponse($response, 'GET', $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("DataCite API connection error: {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to DataCite API: {$e->getMessage()}");
        }
    }

    /**
     * Execute a DataCite GraphQL query.
     *
     * @param  array<string, mixed>  $variables  GraphQL variables.
     * @return array<string, mixed>
     */
    public function graphql(string $query, array $variables = []): array
    {
        if ($query === '') {
            throw new RuntimeException('query is required.');
        }

        try {
            $response = Http::acceptJson()
                ->withUserAgent('OpenCompany Integrations datacite/1.0 (mailto:agent@example.test)')
                ->timeout(60)
                ->post($this->graphqlUrl, ['query' => $query, 'variables' => $variables]);

            return $this->parseResponse($response, 'POST', 'graphql');
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('DataCite GraphQL connection error', ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to DataCite GraphQL API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize JSON:API query arrays into comma-separated values.
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
                $value = implode(',', array_map(static fn (mixed $item): string => (string) $item, array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== '')));
            }

            if ($value !== '') {
                $normalized[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
            }
        }

        return $normalized;
    }

    /**
     * Parse JSON responses and convert DataCite errors to exceptions.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $method, string $path): array
    {
        $json = $response->json();
        $hasErrors = is_array($json) && isset($json['errors']) && $json['errors'] !== [];

        if (!$response->successful() || $hasErrors) {
            $message = $this->errorMessage($json) ?? $response->body();
            Log::error("DataCite API error: {$method} {$path}", ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('DataCite API error ('.$response->status().'): '.$message);
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Extract a readable error message from REST or GraphQL error payloads.
     */
    private function errorMessage(mixed $json): ?string
    {
        if (!is_array($json)) {
            return null;
        }

        $errors = $json['errors'] ?? null;
        if (is_array($errors) && isset($errors[0]) && is_array($errors[0])) {
            return (string) ($errors[0]['title'] ?? $errors[0]['detail'] ?? $errors[0]['message'] ?? 'Unknown DataCite error.');
        }

        return is_string($json['message'] ?? null) ? $json['message'] : null;
    }
}
