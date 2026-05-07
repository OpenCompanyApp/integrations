<?php

namespace OpenCompany\Integrations\Confluent;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Confluent Cloud REST APIs.
 *
 * Executes official OpenAPI operation metadata, supports Confluent Cloud API
 * key Basic auth and token auth, and normalizes API error responses for tools.
 */
class ConfluentService
{
    /**
     * @param  string  $apiKey  Confluent Cloud API key id for Basic auth.
     * @param  string  $apiSecret  Confluent Cloud API secret for Basic auth.
     * @param  string  $accessToken  OAuth, STS, external, or partner bearer token.
     * @param  string  $apiToken  Legacy single-token credential, sent as bearer token when no key/secret pair is configured.
     * @param  string  $clusterId  Default Kafka cluster id for legacy helpers.
     * @param  string  $baseUrl  Confluent Cloud API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $apiSecret = '',
        private string $accessToken = '',
        private string $apiToken = '',
        private string $clusterId = '',
        private string $baseUrl = 'https://api.confluent.cloud',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has enough credentials configured.
     */
    public function isConfigured(): bool
    {
        return ($this->apiKey !== '' && $this->apiSecret !== '') || $this->accessToken !== '' || $this->apiToken !== '';
    }

    /**
     * Return official Confluent Cloud operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return ConfluentOperations::all();
    }

    /**
     * Execute an official Confluent Cloud OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from ConfluentOperations.
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

            if ($value === null && $apiName === 'cluster_id' && $this->clusterId !== '') {
                $value = $this->clusterId;
            }

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

        return $this->request((string) $operation['method'], $this->baseUrl . $path, $query, $headers, $body);
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
            throw new \RuntimeException("Unknown Confluent Cloud operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /** @param  array<string, mixed>  $params  Query parameters. @return array<string, mixed> */
    public function listTopics(array $params = []): array
    {
        return $this->executeSlug('confluent_list_topics', $params);
    }

    /** @return array<string, mixed> */
    public function getTopic(string $topicName, ?string $clusterId = null): array
    {
        return $this->executeSlug('confluent_get_topic', array_filter(['topic_name' => $topicName, 'cluster_id' => $clusterId], static fn ($value): bool => $value !== null));
    }

    /** @param  array<string, mixed>  $body  Topic definition. @return array<string, mixed> */
    public function createTopic(array $body, ?string $clusterId = null): array
    {
        return $this->executeSlug('confluent_create_topic', array_filter(['body' => $body, 'cluster_id' => $clusterId], static fn ($value): bool => $value !== null));
    }

    /** @param  array<string, mixed>  $params  Query parameters. @return array<string, mixed> */
    public function listClusters(array $params = []): array
    {
        return $this->executeSlug('confluent_list_clusters', $params);
    }

    /** @return array<string, mixed> */
    public function getCluster(?string $clusterId = null): array
    {
        return $this->executeSlug('confluent_get_cluster', array_filter(['cluster_id' => $clusterId], static fn ($value): bool => $value !== null));
    }

    /** @param  array<string, mixed>  $params  Query parameters. @return array<string, mixed> */
    public function listEnvironments(array $params = []): array
    {
        return $this->executeSlug('confluent_list_environments', $params);
    }

    /** @return array<string, mixed> */
    public function healthCheck(): array
    {
        return $this->listEnvironments(['page_size' => 1]);
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
     * Make a raw HTTP request to the Confluent Cloud API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     */
    private function rawRequest(string $method, string $url, array $query = [], array $headers = [], mixed $body = null): Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Confluent Cloud credentials are not configured. Provide an api_key/api_secret pair or an access token.');
        }

        try {
            $http = Http::withHeaders(array_merge($this->authHeaders(), [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ], $headers))->timeout(120);

            $response = $this->sendRequest($http, $method, $url, $query, $body);

            if (!$response->successful()) {
                $error = $response->json('errors') ?? $response->json('message') ?? $response->json('error.message') ?? $response->body();
                Log::error("Confluent Cloud API error: {$method} {$url}", ['status' => $response->status(), 'error' => $error]);
                throw new \RuntimeException('Confluent Cloud API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Confluent Cloud API connection error: {$method} {$url}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Confluent Cloud API: {$e->getMessage()}");
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

    /** @return array<string, string> */
    private function authHeaders(): array
    {
        if ($this->apiKey !== '' && $this->apiSecret !== '') {
            return ['Authorization' => 'Basic ' . base64_encode($this->apiKey . ':' . $this->apiSecret)];
        }

        $token = $this->accessToken !== '' ? $this->accessToken : $this->apiToken;

        return ['Authorization' => 'Bearer ' . $token];
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
