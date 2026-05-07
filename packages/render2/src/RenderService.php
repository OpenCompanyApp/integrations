<?php

namespace OpenCompany\Integrations\Render2;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Render REST API.
 *
 * Handles bearer-token authentication, OpenAPI operation execution, request
 * body encoding, multipart upload dispatch, non-JSON responses, and API errors.
 */
class RenderService
{
    /**
     * @param  string  $apiKey  Render API key.
     * @param  string  $baseUrl  Render API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.render.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Return official Render operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return RenderOperations::all();
    }

    /**
     * Execute an official Render OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from RenderOperations.
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
     * Execute an operation by slug.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function executeSlug(string $slug, array $args = []): array
    {
        $operations = self::operations();

        if (!isset($operations[$slug])) {
            throw new \RuntimeException("Unknown Render operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /**
     * List all services in the account.
     *
     * @return array<string, mixed>
     */
    public function listServices(?int $limit = null, ?string $cursor = null): array
    {
        return $this->executeSlug('render_list_services', array_filter([
            'limit' => $limit,
            'cursor' => $cursor,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Get details for a single service.
     *
     * @return array<string, mixed>
     */
    public function getService(string $serviceId): array
    {
        return $this->executeSlug('render_get_service', ['service_id' => $serviceId]);
    }

    /**
     * Create a new service.
     *
     * @param  array<string, mixed>  $params  Service creation body.
     * @return array<string, mixed>
     */
    public function createService(array $params): array
    {
        return $this->executeSlug('render_create_service', ['body' => $params]);
    }

    /**
     * List deploys for a service.
     *
     * @return array<string, mixed>
     */
    public function listDeploys(string $serviceId, ?int $limit = null, ?string $cursor = null): array
    {
        return $this->executeSlug('render_list_deploys', array_filter([
            'service_id' => $serviceId,
            'limit' => $limit,
            'cursor' => $cursor,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Get details for a specific deploy.
     *
     * @return array<string, mixed>
     */
    public function getDeploy(string $serviceId, string $deployId): array
    {
        return $this->executeSlug('render_get_deploy', [
            'service_id' => $serviceId,
            'deploy_id' => $deployId,
        ]);
    }

    /**
     * List jobs for a service.
     *
     * @return array<string, mixed>
     */
    public function listJobs(string $serviceId, ?int $limit = null, ?string $cursor = null): array
    {
        return $this->executeSlug('render_list_jobs', array_filter([
            'service_id' => $serviceId,
            'limit' => $limit,
            'cursor' => $cursor,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Get information about the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->executeSlug('render_get_current_user');
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
     * Make a raw HTTP request to the Render API.
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
        if ($this->apiKey === '') {
            throw new \RuntimeException('Render API key is not configured.');
        }

        try {
            $http = Http::withToken($this->apiKey)
                ->withHeaders(array_merge([
                    'Accept' => 'application/json',
                ], $headers))
                ->timeout(120);

            $response = $this->sendRequest($http, $method, $url, $query, $body, $contentTypes);

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $rawBody = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($rawBody), '<!DOCTYPE')) {
                    Log::warning("Render API returned HTML for {$method} {$url}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Render API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $rawBody;
                Log::error("Render API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Render API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Render API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Render API: {$e->getMessage()}");
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

        if (in_array('multipart/form-data', $contentTypes, true)) {
            $payload = is_array($body) ? $body : [];
            foreach ($payload as $key => $value) {
                if (is_string($value) && is_file($value)) {
                    $http = $http->attach($key, file_get_contents($value) ?: '', basename($value));
                    unset($payload[$key]);
                    continue;
                }

                if (is_array($value)) {
                    $payload[$key] = json_encode($value);
                }
            }

            return $http->post($url, $payload);
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
