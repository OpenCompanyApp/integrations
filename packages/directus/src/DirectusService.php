<?php

namespace OpenCompany\Integrations\Directus;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Directus REST API.
 *
 * Executes generated OpenAPI operation metadata, handles bearer-token
 * authentication when configured, and parses Directus API errors.
 */
class DirectusService
{
    /**
     * @param  string  $accessToken  Directus static token or temporary access token.
     * @param  string  $baseUrl  Base URL of the Directus instance.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://directus.example.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an access token configured.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '' && $this->baseUrl !== '';
    }

    /**
     * Return official Directus operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return DirectusOperations::all();
    }

    /**
     * Execute an official Directus OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from DirectusOperations.
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
            throw new \RuntimeException("Unknown Directus operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /**
     * List items in a collection.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listItems(string $collection, array $params = []): array
    {
        return $this->executeSlug('directus_list_items', array_merge(['collection' => $collection], $params));
    }

    /**
     * Get a single item by primary key.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function getItem(string $collection, int|string $id, array $params = []): array
    {
        return $this->executeSlug('directus_get_item', array_merge(['collection' => $collection, 'id' => $id], $params));
    }

    /**
     * Create a new item in a collection.
     *
     * @param  array<string, mixed>  $data  Item fields.
     * @return array<string, mixed>
     */
    public function createItem(string $collection, array $data): array
    {
        return $this->executeSlug('directus_create_item', ['collection' => $collection, 'body' => $data]);
    }

    /**
     * Update an item in a collection.
     *
     * @param  array<string, mixed>  $data  Item fields.
     * @return array<string, mixed>
     */
    public function updateItem(string $collection, int|string $id, array $data): array
    {
        return $this->executeSlug('directus_update_item', ['collection' => $collection, 'id' => $id, 'body' => $data]);
    }

    /**
     * Delete an item from a collection.
     *
     * @return array<string, mixed>
     */
    public function deleteItem(string $collection, int|string $id): array
    {
        return $this->executeSlug('directus_delete_item', ['collection' => $collection, 'id' => $id]);
    }

    /**
     * List Directus collections.
     *
     * @return array<string, mixed>
     */
    public function listCollections(): array
    {
        return $this->executeSlug('directus_list_collections');
    }

    /**
     * Get the currently authenticated Directus user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->executeSlug('directus_get_current_user');
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
     * Make a raw HTTP request to the Directus REST API.
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

            if ($this->accessToken !== '') {
                $http = $http->withToken($this->accessToken);
            }

            $response = $this->sendRequest($http, $method, $url, $query, $body);

            if (!$response->successful()) {
                $error = $response->json('errors.0.message')
                    ?? $response->json('error')
                    ?? $response->json('message')
                    ?? $response->body();

                Log::error("Directus API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException('Directus API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Directus API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Directus API: {$e->getMessage()}");
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