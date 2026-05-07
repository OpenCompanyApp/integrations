<?php

namespace OpenCompany\Integrations\Xata;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for Xata workspace and branch APIs.
 *
 * Supports management endpoints on api.xata.io and data endpoints on a
 * configured Xata database API endpoint.
 */
class XataService
{
    /**
     * @param  string  $apiKey  Xata API key.
     * @param  string  $workspaceId  Xata workspace id for management APIs.
     * @param  string  $apiEndpoint  Xata database endpoint, for example https://example.region.xata.sh.
     * @param  string  $baseUrl  Xata management API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $workspaceId = '',
        private string $apiEndpoint = '',
        private string $baseUrl = 'https://api.xata.io',
    ) {
        $this->apiEndpoint = rtrim($this->apiEndpoint, '/');
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has a usable API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Execute one Xata operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from a tool class.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function executeOperation(array $operation, array $args = []): array
    {
        $path = (string) $operation['path'];
        $query = [];
        $body = $args['body'] ?? null;

        foreach (($operation['path_params'] ?? []) as $name) {
            $value = $this->argument($args, (string) $name);

            if ($value === null || $value === '') {
                throw new \RuntimeException((string) $name . ' is required.');
            }

            $path = str_replace('{' . $name . '}', rawurlencode((string) $value), $path);
        }

        foreach (($operation['query_params'] ?? []) as $name) {
            $value = $this->argument($args, (string) $name);
            if ($value !== null && $value !== '') {
                $query[(string) $name] = $value;
            }
        }

        foreach (($operation['required'] ?? []) as $name) {
            if ($this->argument($args, (string) $name) === null || $this->argument($args, (string) $name) === '') {
                throw new \RuntimeException((string) $name . ' is required.');
            }
        }

        if (($operation['body_from_loose_args'] ?? false) === true && $body === null) {
            $body = $this->bodyFromLooseArguments($args, array_merge(
                $operation['path_params'] ?? [],
                $operation['query_params'] ?? [],
                ['database', 'branch', 'table', 'record_id'],
            ));
        }

        $base = ($operation['scope'] ?? 'data') === 'management'
            ? $this->managementBase()
            : $this->dataBase();

        return $this->request((string) $operation['method'], $base . $path, $query, $body);
    }

    /**
     * Build the base URL for workspace management APIs.
     */
    private function managementBase(): string
    {
        return $this->baseUrl;
    }

    /**
     * Build the base URL for database data APIs.
     */
    private function dataBase(): string
    {
        if ($this->apiEndpoint === '') {
            throw new \RuntimeException('Xata api_endpoint is required for database operations.');
        }

        return $this->apiEndpoint;
    }

    /**
     * Make an authenticated Xata API request and parse JSON.
     *
     * @param  array<string, mixed>  $query  Query-string values.
     * @param  mixed  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $url, array $query = [], mixed $body = null): array
    {
        $response = $this->rawRequest($method, $url, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Dispatch the raw HTTP request.
     *
     * @param  array<string, mixed>  $query  Query-string values.
     * @param  mixed  $body  JSON request body.
     */
    private function rawRequest(string $method, string $url, array $query, mixed $body): Response
    {
        if ($this->apiKey === '') {
            throw new \RuntimeException('Xata API key is not configured.');
        }

        if ($query !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
        }

        try {
            $http = Http::withToken($this->apiKey)
                ->acceptJson()
                ->asJson()
                ->timeout(60);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body ?? []),
                'PUT' => $http->put($url, $body ?? []),
                'PATCH' => $http->patch($url, $body ?? []),
                'DELETE' => $http->delete($url, is_array($body) ? $body : []),
                default => throw new \RuntimeException("Unsupported Xata HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("Xata API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Xata API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Xata API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Xata API: {$e->getMessage()}");
        }
    }

    /**
     * Read an argument using exact or snake_case names.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function argument(array $args, string $name): mixed
    {
        return $args[$name] ?? $args[$this->snakeName($name)] ?? null;
    }

    /**
     * Convert loose tool args into a JSON request body.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $consumed  Keys used outside the body.
     * @return array<string, mixed>
     */
    private function bodyFromLooseArguments(array $args, array $consumed): array
    {
        $skip = array_fill_keys($consumed, true);
        foreach ($consumed as $key) {
            $skip[$this->snakeName((string) $key)] = true;
        }

        $body = [];
        foreach ($args as $key => $value) {
            if (!isset($skip[$key]) && $value !== null) {
                $body[$key] = $value;
            }
        }

        return $body;
    }

    /**
     * Convert camelCase API names to snake_case tool aliases.
     */
    private function snakeName(string $name): string
    {
        return strtolower((string) preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
    }
}
