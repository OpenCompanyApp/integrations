<?php

namespace OpenCompany\Integrations\CockroachDb;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the CockroachDB Cloud API.
 *
 * Executes generated OpenAPI operation metadata, handles bearer-token
 * authentication, encodes JSON request bodies, and parses API errors.
 */
class CockroachDbService
{
    /**
     * @param  string  $accessToken  CockroachDB Cloud API key.
     * @param  string  $baseUrl  CockroachDB Cloud API root URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://cockroachlabs.cloud',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '' && $this->baseUrl !== '';
    }

    /**
     * Return official CockroachDB Cloud operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return CockroachDbOperations::all();
    }

    /**
     * Execute an official CockroachDB Cloud OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from CockroachDbOperations.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function executeOperation(array $operation, array $args = []): array
    {
        $path = (string) $operation['path'];
        $query = [];
        $headers = [];
        $consumed = [];

        foreach ($operation['parameters'] ?? [] as $parameter) {
            $name = (string) $parameter['name'];
            $value = $this->argument($args, $name);

            if ($value === null) {
                if (!empty($parameter['required'])) {
                    throw new \RuntimeException("The {$this->snakeName($name)} parameter is required.");
                }

                continue;
            }

            $consumed[] = $name;
            $consumed[] = $this->snakeName($name);
            $consumed[] = strtolower($name);

            if ($parameter['in'] === 'path') {
                $path = str_replace('{' . $name . '}', rawurlencode((string) $value), $path);
            } elseif ($parameter['in'] === 'query') {
                $query[$name] = $value;
            } elseif ($parameter['in'] === 'header') {
                $headers[$name] = $value;
            }
        }

        $requestBody = $operation['request_body'] ?? null;
        $body = null;

        if ($requestBody !== null) {
            $body = $args['body'] ?? $this->bodyFromLooseArguments($args, $consumed);

            if (!empty($requestBody['required']) && ($body === null || $body === [] || $body === '')) {
                throw new \RuntimeException('body is required.');
            }
        }

        return $this->request(
            (string) $operation['method'],
            $this->urlForPath($path),
            $query,
            $headers,
            $body,
        );
    }

    /**
     * Execute an operation by generated slug.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function executeSlug(string $slug, array $args = []): array
    {
        $operations = self::operations();

        if (!isset($operations[$slug])) {
            throw new \RuntimeException("Unknown CockroachDB Cloud operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /**
     * List all clusters visible to the API key.
     *
     * @return array<string, mixed>
     */
    public function listClusters(?int $limit = null, ?string $page = null): array
    {
        return $this->executeSlug('cockroachdb_list_clusters', array_filter([
            'pagination.limit' => $limit,
            'pagination.page' => $page,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Get details for a single cluster.
     *
     * @return array<string, mixed>
     */
    public function getCluster(string $clusterId): array
    {
        return $this->executeSlug('cockroachdb_get_cluster', ['cluster_id' => $clusterId]);
    }

    /**
     * Create a new CockroachDB Cloud cluster.
     *
     * @param  array<string, mixed>  $params  Cluster creation body.
     * @return array<string, mixed>
     */
    public function createCluster(array $params): array
    {
        return $this->executeSlug('cockroachdb_create_cluster', ['body' => $params]);
    }

    /**
     * List databases in a cluster.
     *
     * @return array<string, mixed>
     */
    public function listDatabases(string $clusterId, ?int $limit = null, ?string $page = null): array
    {
        return $this->executeSlug('cockroachdb_list_databases', array_filter([
            'cluster_id' => $clusterId,
            'pagination.limit' => $limit,
            'pagination.page' => $page,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * List SQL users in a cluster.
     *
     * @return array<string, mixed>
     */
    public function listUsers(string $clusterId, ?int $limit = null, ?string $page = null): array
    {
        return $this->executeSlug('cockroachdb_list_users', array_filter([
            'cluster_id' => $clusterId,
            'pagination.limit' => $limit,
            'pagination.page' => $page,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Make an API request and return parsed output.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $url, array $query = [], array $headers = [], mixed $body = null): array
    {
        $response = $this->rawRequest($method, $url, $query, $headers, $body);

        if ($response->status() === 204) {
            return [];
        }

        $contentType = (string) $response->header('Content-Type');

        if (!str_contains($contentType, 'json')) {
            return [
                'body' => $response->body(),
                'content_type' => $contentType,
            ];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the CockroachDB Cloud API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     */
    private function rawRequest(string $method, string $url, array $query = [], array $headers = [], mixed $body = null): Response
    {
        if ($this->accessToken === '') {
            throw new \RuntimeException('CockroachDB Cloud access token is not configured.');
        }

        try {
            $http = Http::withToken($this->accessToken)
                ->withHeaders(array_merge([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ], $headers))
                ->timeout(120);

            $response = $this->sendRequest($http, $method, $url, $query, $body);

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $rawBody = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($rawBody), '<!DOCTYPE')) {
                    Log::warning("CockroachDB Cloud API returned HTML for {$method} {$url}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("CockroachDB Cloud API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $rawBody;
                Log::error("CockroachDB Cloud API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("CockroachDB Cloud API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("CockroachDB Cloud API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to CockroachDB Cloud API: {$e->getMessage()}");
        }
    }

    /**
     * Dispatch the request with the appropriate HTTP verb.
     *
     * @param  PendingRequest  $http  Pending HTTP request.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  mixed  $body  Request body.
     */
    private function sendRequest(PendingRequest $http, string $method, string $url, array $query, mixed $body): Response
    {
        $method = strtoupper($method);

        if ($query !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
        }

        return match ($method) {
            'GET' => $http->get($url),
            'POST' => $http->post($url, $body ?? []),
            'PUT' => $http->put($url, $body ?? []),
            'PATCH' => $http->patch($url, $body ?? []),
            'DELETE' => $http->delete($url, is_array($body) ? $body : []),
            default => $http->send($method, $url, ['json' => $body ?? []]),
        };
    }

    /**
     * Build a request URL while tolerating legacy base URLs ending in /api/v1.
     */
    private function urlForPath(string $path): string
    {
        $baseUrl = $this->baseUrl;

        if (str_ends_with($baseUrl, '/api/v1') && str_starts_with($path, '/api/v1/')) {
            $path = substr($path, strlen('/api/v1'));
        }

        return $baseUrl . $path;
    }

    /**
     * Resolve an argument by exact, snake_case, or lower-case parameter name.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function argument(array $args, string $name): mixed
    {
        foreach ([$name, $this->snakeName($name), strtolower($name)] as $key) {
            if (array_key_exists($key, $args)) {
                return $args[$key];
            }
        }

        return null;
    }

    private function snakeName(string $name): string
    {
        $name = (string) preg_replace('/(?<!^)[A-Z]/', '_$0', $name);
        $name = (string) preg_replace('/[^A-Za-z0-9]+/', '_', $name);
        $name = (string) preg_replace('/_+/', '_', $name);

        return strtolower(trim($name, '_'));
    }

    /**
     * Build a request body from arguments that are not path/query/header params.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $consumed  Already consumed parameter names.
     * @return array<string, mixed>
     */
    private function bodyFromLooseArguments(array $args, array $consumed): array
    {
        $body = [];
        $consumed = array_flip($consumed);

        foreach ($args as $key => $value) {
            if (!isset($consumed[$key])) {
                $body[$key] = $value;
            }
        }

        return $body;
    }
}
