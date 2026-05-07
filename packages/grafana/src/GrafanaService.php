<?php

namespace OpenCompany\Integrations\Grafana;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Grafana HTTP API.
 *
 * Executes generated OpenAPI operation metadata, handles bearer-token
 * authentication, encodes JSON and YAML bodies, and normalizes API errors.
 */
class GrafanaService
{
    /**
     * @param  string  $apiToken  Grafana service account token or API token.
     * @param  string  $baseUrl  Grafana API base URL, including the /api prefix.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'http://localhost:3000/api',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has a token and base URL configured.
     */
    public function isConfigured(): bool
    {
        return $this->apiToken !== '' && $this->baseUrl !== '';
    }

    /**
     * Return the configured Grafana API base URL.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Return official Grafana operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return GrafanaOperations::all();
    }

    /**
     * Execute an official Grafana OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from GrafanaOperations.
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
            $this->baseUrl . $path,
            $query,
            $headers,
            $body,
            $requestBody['content_types'] ?? [],
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
            throw new \RuntimeException("Unknown Grafana operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /**
     * Search dashboards and folders through Grafana's search endpoint.
     *
     * @return array<string, mixed>
     */
    public function listDashboards(?string $query = null, string $type = 'dash-db', int $limit = 100): array
    {
        return $this->executeSlug('grafana_list_dashboards', array_filter([
            'query' => $query,
            'type' => $type,
            'limit' => $limit,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Get a dashboard by UID.
     *
     * @return array<string, mixed>
     */
    public function getDashboard(string $uid): array
    {
        return $this->executeSlug('grafana_get_dashboard', ['uid' => $uid]);
    }

    /**
     * Create or update a dashboard.
     *
     * @param  array<string, mixed>  $dashboard  Dashboard JSON model.
     * @return array<string, mixed>
     */
    public function createDashboard(array $dashboard, string $folderUid = '', bool $overwrite = false): array
    {
        $body = [
            'dashboard' => $dashboard,
            'overwrite' => $overwrite,
        ];

        if ($folderUid !== '') {
            $body['folderUid'] = $folderUid;
        }

        return $this->executeSlug('grafana_create_dashboard', ['body' => $body]);
    }

    /**
     * List configured data sources.
     *
     * @return array<string, mixed>
     */
    public function listDatasources(): array
    {
        return $this->executeSlug('grafana_list_datasources');
    }

    /**
     * List Grafana-managed alert rules.
     *
     * Legacy dashboard and panel filters are ignored because the official
     * provisioning alert-rules endpoint in the current spec does not expose them.
     *
     * @return array<string, mixed>
     */
    public function listAlerts(?int $dashboardId = null, ?int $panelId = null): array
    {
        return $this->executeSlug('grafana_list_alerts');
    }

    /**
     * Search teams with paging.
     *
     * @return array<string, mixed>
     */
    public function listTeams(int $page = 1, int $perPage = 50): array
    {
        return $this->executeSlug('grafana_list_teams', [
            'page' => $page,
            'perpage' => $perPage,
        ]);
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->executeSlug('grafana_get_current_user');
    }

    /**
     * Make an API request and return parsed output.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     * @param  array<int, string>  $contentTypes  Request body content types from OpenAPI.
     * @return array<string, mixed>
     */
    private function request(string $method, string $url, array $query = [], array $headers = [], mixed $body = null, array $contentTypes = []): array
    {
        $response = $this->rawRequest($method, $url, $query, $headers, $body, $contentTypes);

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
     * Make a raw HTTP request to the Grafana API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     * @param  array<int, string>  $contentTypes  Request body content types from OpenAPI.
     */
    private function rawRequest(string $method, string $url, array $query = [], array $headers = [], mixed $body = null, array $contentTypes = []): Response
    {
        if ($this->apiToken === '') {
            throw new \RuntimeException('Grafana API token is not configured.');
        }

        try {
            $http = Http::withToken($this->apiToken)
                ->withHeaders(array_merge([
                    'Accept' => 'application/json',
                ], $headers))
                ->timeout(120);

            $response = $this->sendRequest($http, $method, $url, $query, $body, $contentTypes);

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $rawBody = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($rawBody), '<!DOCTYPE')) {
                    Log::warning("Grafana API returned HTML for {$method} {$url}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Grafana API endpoint not available (HTTP {$response->status()}). Check that the base URL includes /api.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $rawBody;
                Log::error("Grafana API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Grafana API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Grafana API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Grafana API: {$e->getMessage()}");
        }
    }

    /**
     * Dispatch the request with the appropriate body encoder.
     *
     * @param  PendingRequest  $http  Pending HTTP request.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  mixed  $body  Request body.
     * @param  array<int, string>  $contentTypes  Request body content types from OpenAPI.
     */
    private function sendRequest(PendingRequest $http, string $method, string $url, array $query, mixed $body, array $contentTypes): Response
    {
        $method = strtoupper($method);

        if ($query !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
        }

        if (in_array('application/yaml', $contentTypes, true) && !in_array('application/json', $contentTypes, true)) {
            $payload = is_scalar($body) ? (string) $body : json_encode($body);

            return $http->withBody((string) $payload, 'application/yaml')->send($method, $url);
        }

        return match ($method) {
            'GET' => $http->get($url),
            'POST' => $http->post($url, $body ?? []),
            'PATCH' => $http->patch($url, $body ?? []),
            'PUT' => $http->put($url, $body ?? []),
            'DELETE' => $http->delete($url, is_array($body) ? $body : []),
            default => $http->send($method, $url, ['json' => $body ?? []]),
        };
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
