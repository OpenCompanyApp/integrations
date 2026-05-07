<?php

namespace OpenCompany\Integrations\ArgoCd;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Argo CD API.
 *
 * Executes generated Swagger operation metadata, handles bearer-token
 * authentication when configured, and parses Argo CD API errors.
 */
class ArgoCdService
{
    private const DEFAULT_BASE_URL = 'https://argocd.example.com';

    /**
     * @param  string  $token  Argo CD bearer token.
     * @param  string  $baseUrl  Argo CD server root URL or legacy /api/v1 URL.
     */
    public function __construct(
        private string $token = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');

        if (str_ends_with($this->baseUrl, '/api/v1')) {
            $this->baseUrl = substr($this->baseUrl, 0, -strlen('/api/v1'));
        }
    }

    /**
     * Check whether the Argo CD token has been configured.
     */
    public function isConfigured(): bool
    {
        return $this->token !== '' && $this->baseUrl !== '';
    }

    /**
     * Return official Argo CD operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return ArgoCdOperations::all();
    }

    /**
     * Execute an official Argo CD Swagger operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from ArgoCdOperations.
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
            throw new \RuntimeException("Unknown Argo CD operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /**
     * List Argo CD applications.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listApplications(array $params = []): array
    {
        return $this->executeSlug('argocd_list_applications', $params);
    }

    /**
     * Get an Argo CD application by name.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function getApplication(string $name, array $params = []): array
    {
        return $this->executeSlug('argocd_get_application', array_merge(['name' => $name], $params));
    }

    /**
     * Create a new Argo CD application.
     *
     * @param  array<string, mixed>  $params  Application request body or loose fields.
     * @return array<string, mixed>
     */
    public function createApplication(array $params): array
    {
        return $this->executeSlug('argocd_create_application', ['body' => $params]);
    }

    /**
     * List Argo CD projects.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->executeSlug('argocd_list_projects', $params);
    }

    /**
     * Get an Argo CD project by name.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $name): array
    {
        return $this->executeSlug('argocd_get_project', ['name' => $name]);
    }

    /**
     * List configured Argo CD repositories.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listRepositories(array $params = []): array
    {
        return $this->executeSlug('argocd_list_repositories', $params);
    }

    /**
     * Get the currently authenticated Argo CD user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->executeSlug('argocd_get_current_user');
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

        if ($response->status() === 204 || $response->body() === '') {
            return ['success' => true];
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
     * Make a raw HTTP request to the Argo CD API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     */
    private function rawRequest(string $method, string $url, array $query = [], array $headers = [], mixed $body = null): Response
    {
        try {
            $http = Http::withHeaders(array_merge([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ], $headers))->timeout(120);

            if ($this->token !== '') {
                $http = $http->withToken($this->token);
            }

            $response = $this->sendRequest($http, $method, $url, $query, $body);

            if ($response->status() === 429) {
                throw new \RuntimeException('Argo CD rate limit exceeded.');
            }

            if (!$response->successful()) {
                $error = $response->json('message')
                    ?? $response->json('error')
                    ?? $response->body();

                Log::error("Argo CD API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException('Argo CD API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Argo CD API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Argo CD API: {$e->getMessage()}");
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