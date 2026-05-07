<?php

namespace OpenCompany\Integrations\Replicate;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Replicate REST API.
 *
 * Handles bearer-token authentication, OpenAPI operation execution, request
 * body encoding, multipart uploads, non-JSON downloads, and error parsing.
 */
class ReplicateService
{
    /**
     * @param  string  $apiKey  Replicate API token.
     * @param  string  $baseUrl  Replicate API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.replicate.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Execute an official Replicate OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from ReplicateOperations.
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
                    throw new \RuntimeException("{$name} is required.");
                }

                continue;
            }

            $consumed[] = $name;
            $consumed[] = $this->snakeName($name);

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

        $method = (string) $operation['method'];
        $url = $this->baseUrl . $path;

        return $this->request($method, $url, $query, $headers, $body, $requestBody['content_types'] ?? []);
    }

    /**
     * Make an API request and return parsed output.
     *
     * @param  string  $method  HTTP method, including Replicate's QUERY method.
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
     * Make a raw HTTP request to the Replicate API.
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
            throw new \RuntimeException('Replicate API key is not configured.');
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
                    Log::warning("Replicate API returned HTML for {$method} {$url}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Replicate API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('detail') ?? $response->json('error') ?? $rawBody;
                Log::error("Replicate API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Replicate API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Replicate API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Replicate API: {$e->getMessage()}");
        }
    }

    /**
     * Dispatch the request with the appropriate body encoder.
     *
     * @param  \Illuminate\Http\Client\PendingRequest  $http  Pending HTTP request.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  mixed  $body  Request body.
     * @param  array<int, string>  $contentTypes  Request body content types from OpenAPI.
     */
    private function sendRequest(\Illuminate\Http\Client\PendingRequest $http, string $method, string $url, array $query, mixed $body, array $contentTypes): Response
    {
        $method = strtoupper($method);

        if ($query !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
        }

        if (in_array('multipart/form-data', $contentTypes, true)) {
            $payload = is_array($body) ? $body : [];
            $content = $payload['content'] ?? '';
            $filename = (string) ($payload['filename'] ?? 'upload');

            if (is_string($content) && is_file($content)) {
                $content = file_get_contents($content);
            }

            $http = $http->attach('content', (string) $content, $filename);
            unset($payload['content']);

            foreach ($payload as $key => $value) {
                if (is_array($value)) {
                    $payload[$key] = json_encode($value);
                }
            }

            return $http->post($url, $payload);
        }

        if (in_array('text/plain', $contentTypes, true)) {
            return $http->withBody(is_scalar($body) ? (string) $body : json_encode($body), 'text/plain')->send($method, $url);
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
