<?php

namespace OpenCompany\Integrations\Docker;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Docker Hub API.
 *
 * Executes generated OpenAPI operation metadata, handles bearer-token
 * authentication, encodes JSON bodies, and parses Docker Hub API errors.
 */
class DockerService
{
    /**
     * @param  string  $accessToken  Docker Hub personal access token or bearer token.
     * @param  string  $baseUrl  Docker Hub API root URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://hub.docker.com',
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
     * Return official Docker Hub operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return DockerOperations::all();
    }

    /**
     * Execute an official Docker Hub OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from DockerOperations.
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
            throw new \RuntimeException("Unknown Docker Hub operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /**
     * List repositories for a namespace.
     *
     * @return array<string, mixed>
     */
    public function listRepositories(string $namespace, int $perPage = 25, int $page = 1): array
    {
        return $this->executeSlug('docker_list_repositories', [
            'namespace' => $namespace,
            'page_size' => $perPage,
            'page' => $page,
        ]);
    }

    /**
     * Get a single repository by namespace and repository name.
     *
     * @return array<string, mixed>
     */
    public function getRepository(string $namespace, string $repository): array
    {
        return $this->executeSlug('docker_get_repository', [
            'namespace' => $namespace,
            'repository' => $repository,
        ]);
    }

    /**
     * List tags for a repository.
     *
     * @return array<string, mixed>
     */
    public function listTags(string $namespace, string $repository, int $perPage = 25, int $page = 1): array
    {
        return $this->executeSlug('docker_list_tags', [
            'namespace' => $namespace,
            'repository' => $repository,
            'page_size' => $perPage,
            'page' => $page,
        ]);
    }

    /**
     * Get a specific tag for a repository.
     *
     * @return array<string, mixed>
     */
    public function getTag(string $namespace, string $repository, string $tag): array
    {
        return $this->executeSlug('docker_get_tag', [
            'namespace' => $namespace,
            'repository' => $repository,
            'tag' => $tag,
        ]);
    }

    /**
     * Create a new repository.
     *
     * @return array<string, mixed>
     */
    public function createRepository(
        string $namespace,
        string $name,
        string $description = '',
        string $fullDescription = '',
        bool $isPrivate = false,
    ): array {
        $body = [
            'name' => $name,
            'is_private' => $isPrivate,
        ];

        if ($description !== '') {
            $body['description'] = $description;
        }

        if ($fullDescription !== '') {
            $body['full_description'] = $fullDescription;
        }

        return $this->executeSlug('docker_create_repository', [
            'namespace' => $namespace,
            'body' => $body,
        ]);
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
     * Make a raw HTTP request to the Docker Hub API.
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
            throw new \RuntimeException('Docker Hub API token is not configured.');
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
                    Log::warning("Docker Hub API returned HTML for {$method} {$url}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Docker Hub API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('detail') ?? $response->json('error') ?? $response->json('message') ?? $rawBody;
                Log::error("Docker Hub API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Docker Hub API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Docker Hub API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Docker Hub API: {$e->getMessage()}");
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
     * Build a request URL while tolerating legacy base URLs ending in /v2.
     */
    private function urlForPath(string $path): string
    {
        $baseUrl = $this->baseUrl;

        if (str_ends_with($baseUrl, '/v2') && str_starts_with($path, '/v2/')) {
            $path = substr($path, strlen('/v2'));
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
