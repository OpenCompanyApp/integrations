<?php

namespace OpenCompany\Integrations\Dialpad;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the official Dialpad API.
 *
 * Handles API-key authentication, operation request mapping, and response parsing for generated tools.
 */
class DialpadService
{
    /**
     * @param  string  $accessToken  Dialpad API key.
     * @param  string  $baseUrl  Dialpad API host root, such as https://dialpad.com or https://sandbox.dialpad.com.
     * @param  string  $authMode  Authentication mode: bearer or query.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://dialpad.com',
        private string $authMode = 'bearer',
    ) {
        $this->baseUrl = rtrim($baseUrl !== '' ? $baseUrl : 'https://dialpad.com', '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Return all official Dialpad operations exposed by this integration.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return DialpadOperations::all();
    }

    /**
     * Return one operation definition by slug.
     *
     * @return array<string, mixed>
     */
    public function operation(string $operation): array
    {
        foreach (self::operations() as $definition) {
            if ($definition['slug'] === $operation) {
                return $definition;
            }
        }
        throw new \RuntimeException("Unsupported Dialpad operation: {$operation}");
    }

    /**
     * Execute an official Dialpad operation using normalized tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        $path = (string) $definition['path'];
        foreach ($definition['parameters'] as $parameter) {
            if (($parameter['in'] ?? null) !== 'path') continue;
            $param = (string) $parameter['param'];
            $value = $args[$param] ?? null;
            if ($value === null || $value === '') {
                throw new \RuntimeException("{$param} is required for {$definition['slug']}.");
            }
            $path = str_replace('{'.(string) $parameter['name'].'}', rawurlencode((string) $value), $path);
        }
        $query = $this->prepareQuery($definition, $args);
        $body = $this->prepareBody($definition, $args);
        return $this->request((string) $definition['method'], $path, $query, $body);
    }

    /**
     * Build query parameters from normalized and passthrough arguments.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function prepareQuery(array $definition, array $args): array
    {
        $query = [];
        foreach ($definition['parameters'] as $parameter) {
            if (($parameter['in'] ?? null) !== 'query') continue;
            $param = (string) $parameter['param'];
            if (array_key_exists($param, $args)) {
                $query[(string) $parameter['name']] = $args[$param];
            }
        }
        if (isset($args['query']) && is_array($args['query'])) {
            foreach ($args['query'] as $key => $value) {
                $query[(string) $key] = $value;
            }
        }
        if ($this->authMode === 'query') {
            $query['apikey'] = $this->accessToken;
        }
        return $query;
    }

    /**
     * Build the JSON body for write operations.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>|list<mixed>|null
     */
    private function prepareBody(array $definition, array $args): array|null
    {
        if (array_key_exists('body', $args) && is_array($args['body'])) {
            return $args['body'];
        }
        return null;
    }

    /**
     * Send an HTTP request to Dialpad and parse JSON responses.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array|null $body = null): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);
        if ($response->status() === 204) {
            return [];
        }
        $json = $response->json();
        return is_array($json) ? $json : [];
    }

    /**
     * Send a raw HTTP request to Dialpad and raise runtime exceptions on failures.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array|null $body = null): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Dialpad API key is not configured.');
        }
        $url = $this->baseUrl.$path;
        try {
            $http = Http::withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])->timeout(30);
            if ($this->authMode !== 'query') {
                $http = $http->withToken($this->accessToken);
            }
            $options = [];
            if ($query !== []) $options['query'] = $query;
            if ($body !== null) $options['json'] = $body;
            $response = $http->send(strtoupper($method), $url, $options);
            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Dialpad API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new \RuntimeException("Dialpad API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Dialpad API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Dialpad API: {$e->getMessage()}");
        }
    }
}