<?php

namespace OpenCompany\Integrations\Vultr;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Vultr REST API.
 *
 * Executes official OpenAPI operation metadata, sends bearer-token
 * authentication, and normalizes Vultr error responses for generated tools.
 */
class VultrService
{
    /**
     * @param  string  $accessToken  Vultr API key used as a bearer token.
     * @param  string  $baseUrl  Vultr API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.vultr.com/v2',
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
     * Return official Vultr operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return VultrOperations::all();
    }

    /**
     * Execute an official Vultr OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from VultrOperations.
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
            $apiName = (string) $parameter['name'];
            $argumentName = (string) ($parameter['argument_name'] ?? $this->snakeName($apiName));
            $aliases = is_array($parameter['aliases'] ?? null) ? $parameter['aliases'] : [];
            $value = $this->argument($args, $argumentName, $apiName, $aliases);

            if ($value === null) {
                if (!empty($parameter['required'])) {
                    throw new \RuntimeException("The {$argumentName} parameter is required.");
                }

                continue;
            }

            $consumed[] = $apiName;
            $consumed[] = $argumentName;
            $consumed[] = $this->snakeName($apiName);
            $consumed[] = strtolower($apiName);
            foreach ($aliases as $alias) {
                $consumed[] = (string) $alias;
            }

            if ($parameter['in'] === 'path') {
                $path = str_replace('{' . $apiName . '}', rawurlencode((string) $value), $path);
            } elseif ($parameter['in'] === 'query') {
                $query[$apiName] = $value;
            } elseif ($parameter['in'] === 'header') {
                $headers[$apiName] = $value;
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

        return $this->request((string) $operation['method'], $this->buildUrl($path), $query, $headers, $body);
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
            throw new \RuntimeException("Unknown Vultr operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /** @return array<string, mixed> */
    public function getCurrentUser(): array
    {
        return $this->executeSlug('vultr_get_current_user');
    }

    /** @param  array<string, mixed>  $params  Query parameters such as per_page and cursor. @return array<string, mixed> */
    public function listInstances(array $params = []): array
    {
        return $this->executeSlug('vultr_list_instances', $params);
    }

    /** @return array<string, mixed> */
    public function getInstance(string $id): array
    {
        return $this->executeSlug('vultr_get_instance', ['id' => $id]);
    }

    /** @param  array<string, mixed>  $params  Query parameters such as type and per_page. @return array<string, mixed> */
    public function listPlans(array $params = []): array
    {
        return $this->executeSlug('vultr_list_plans', $params);
    }

    /** @param  array<string, mixed>  $params  Query parameters such as per_page. @return array<string, mixed> */
    public function listRegions(array $params = []): array
    {
        return $this->executeSlug('vultr_list_regions', $params);
    }

    /** @param  array<string, mixed>  $params  Query parameters such as per_page and cursor. @return array<string, mixed> */
    public function listSnapshots(array $params = []): array
    {
        return $this->executeSlug('vultr_list_snapshots', $params);
    }

    /** @param  array<string, mixed>  $params  Query parameters such as per_page and cursor. @return array<string, mixed> */
    public function listSshKeys(array $params = []): array
    {
        return $this->executeSlug('vultr_list_ssh_keys', $params);
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
            return [];
        }

        $contentType = (string) $response->header('Content-Type');

        if (!str_contains($contentType, 'json')) {
            return ['body' => $response->body(), 'content_type' => $contentType];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Vultr API.
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
            throw new \RuntimeException('Vultr access token is not configured.');
        }

        try {
            $http = Http::withHeaders(array_merge([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ], $headers))->timeout(120);

            $response = $this->sendRequest($http, $method, $url, $query, $body);

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Vultr API error: {$method} {$url}", ['status' => $response->status(), 'error' => $error]);
                throw new \RuntimeException('Vultr API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Vultr API connection error: {$method} {$url}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Vultr API: {$e->getMessage()}");
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

    private function buildUrl(string $path): string
    {
        if (str_starts_with($path, '/v2/') && str_ends_with($this->baseUrl, '/v2')) {
            $path = substr($path, 3);
        }

        return $this->baseUrl . $path;
    }

    /**
     * Resolve an argument by generated, API, snake_case, lower-case, or alias name.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $aliases  Additional accepted argument names.
     */
    private function argument(array $args, string $argumentName, string $apiName, array $aliases = []): mixed
    {
        foreach (array_merge([$argumentName, $apiName, $this->snakeName($apiName), strtolower($apiName)], $aliases) as $key) {
            if (array_key_exists($key, $args)) {
                return $args[$key];
            }
        }

        return null;
    }

    private function snakeName(string $name): string
    {
        $name = str_replace('[]', '', $name);
        $name = (string) preg_replace('/(?<!^)[A-Z]/', '_$0', $name);
        $name = (string) preg_replace('/[^A-Za-z0-9]+/', '_', $name);
        $name = (string) preg_replace('/_+/', '_', $name);

        return strtolower(trim($name, '_')) ?: 'value';
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
