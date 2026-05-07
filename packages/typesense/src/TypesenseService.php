<?php

namespace OpenCompany\Integrations\Typesense;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Typesense REST API.
 *
 * Executes official OpenAPI operation metadata, sends the Typesense API key
 * header, and normalizes Typesense error responses for tools.
 */
class TypesenseService
{
    /**
     * @param  string  $apiKey  Typesense API key.
     * @param  string  $baseUrl  Base URL of the Typesense node or cluster.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'http://localhost:8108',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '' && $this->baseUrl !== '';
    }

    /**
     * Return official Typesense operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return TypesenseOperations::all();
    }

    /**
     * Execute an official Typesense OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from TypesenseOperations.
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
            $value = $this->argument($args, $argumentName, $apiName);

            if ($value === null && $parameter['in'] === 'query' && str_ends_with($apiName, 'Parameters')) {
                $loose = $this->bodyFromLooseArguments($args, $consumed);
                $value = $loose !== [] ? $loose : null;
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

            if ($parameter['in'] === 'path') {
                $path = str_replace('{' . $apiName . '}', rawurlencode((string) $value), $path);
            } elseif ($parameter['in'] === 'query') {
                if (is_array($value) && str_ends_with($apiName, 'Parameters')) {
                    foreach ($value as $key => $item) {
                        $query[$key] = $item;
                    }
                } else {
                    $query[$apiName] = $value;
                }
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
            throw new \RuntimeException("Unknown Typesense operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /** @return array<string, mixed> */
    public function listCollections(): array
    {
        return $this->executeSlug('typesense_list_collections');
    }

    /** @return array<string, mixed> */
    public function getCollection(string $name): array
    {
        return $this->executeSlug('typesense_get_collection', ['collection_name' => $name]);
    }

    /** @param  array<string, mixed>  $schema  Collection schema. @return array<string, mixed> */
    public function createCollection(array $schema): array
    {
        return $this->executeSlug('typesense_create_collection', ['body' => $schema]);
    }

    /** @param  array<string, mixed>  $params  Search parameters. @return array<string, mixed> */
    public function searchDocuments(string $collection, array $params): array
    {
        return $this->executeSlug('typesense_search_documents', ['collection_name' => $collection, 'search_parameters' => $params]);
    }

    /** @param  array<string, mixed>  $document  Document payload. @return array<string, mixed> */
    public function indexDocument(string $collection, array $document): array
    {
        return $this->executeSlug('typesense_index_document', ['collection_name' => $collection, 'body' => $document]);
    }

    /** @return array<string, mixed> */
    public function getDocument(string $collection, string $id): array
    {
        return $this->executeSlug('typesense_get_document', ['collection_name' => $collection, 'document_id' => $id]);
    }

    /** @return array<string, mixed> */
    public function getHealth(): array
    {
        return $this->executeSlug('typesense_get_health');
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
     * Make a raw HTTP request to the Typesense API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     */
    private function rawRequest(string $method, string $url, array $query = [], array $headers = [], mixed $body = null): Response
    {
        if ($this->apiKey === '') {
            throw new \RuntimeException('Typesense API key is not configured.');
        }

        try {
            $http = Http::withHeaders(array_merge([
                'X-TYPESENSE-API-KEY' => $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ], $headers))->timeout(120);

            $response = $this->sendRequest($http, $method, $url, $query, $body);

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();
                Log::error("Typesense API error: {$method} {$url}", ['status' => $response->status(), 'error' => $error]);
                throw new \RuntimeException('Typesense API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Typesense API connection error: {$method} {$url}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Typesense API: {$e->getMessage()}");
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
     * Resolve an argument by generated, API, snake_case, or lower-case name.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function argument(array $args, string $argumentName, string $apiName): mixed
    {
        foreach ([$argumentName, $apiName, $this->snakeName($apiName), strtolower($apiName)] as $key) {
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
