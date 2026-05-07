<?php

namespace OpenCompany\Integrations\Svix;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Svix REST API.
 *
 * Handles bearer authentication, official operation lookup, request shaping,
 * response parsing, and normalized API errors for all Svix tools.
 */
class SvixService
{
    private const DEFAULT_BASE_URL = 'https://api.svix.com';

    /**
     * @param  string  $authToken  Svix authentication token or self-hosted JWT.
     * @param  string  $baseUrl  Svix API base URL.
     */
    public function __construct(
        private string $authToken = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether the service has an authentication token.
     */
    public function isConfigured(): bool
    {
        return trim($this->authToken) !== '';
    }

    /**
     * Return the official Svix operation map.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return SvixOperations::all();
    }

    /**
     * Return metadata for one Svix operation by tool slug or operation id.
     *
     * @return array<string, mixed>
     */
    public function operation(string $operation): array
    {
        foreach (self::operations() as $definition) {
            if (($definition['slug'] ?? null) === $operation || ($definition['operation'] ?? null) === $operation) {
                return $definition;
            }
        }

        throw new RuntimeException("Unsupported Svix operation: {$operation}");
    }

    /**
     * Execute an official Svix API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        [$path, $query, $payload, $headers] = $this->shapeRequest($definition, $args);

        return $this->request(
            method: (string) $definition['method'],
            path: $path,
            query: $query,
            payload: $payload,
            headers: $headers,
        );
    }

    /**
     * Shape tool arguments into path, query, JSON body, and header data.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array{0: string, 1: array<string, mixed>, 2: array<string, mixed>, 3: array<string, string>}
     */
    private function shapeRequest(array $definition, array $args): array
    {
        $path = (string) $definition['path'];
        $query = isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
        $payload = isset($args['payload']) && is_array($args['payload']) ? $args['payload'] : [];
        $headers = isset($args['headers']) && is_array($args['headers']) ? $this->stringHeaders($args['headers']) : [];
        $consumed = ['query' => true, 'payload' => true, 'headers' => true];

        foreach ($definition['parameters'] as $parameter) {
            $name = (string) $parameter['name'];
            $param = (string) $parameter['param'];
            $value = $args[$param] ?? $args[$name] ?? null;
            $consumed[$param] = true;
            $consumed[$name] = true;

            if (($parameter['required'] ?? false) && ($value === null || $value === '')) {
                throw new RuntimeException($param.' is required.');
            }

            if ($value === null || $value === '') {
                continue;
            }

            match ((string) $parameter['in']) {
                'path' => $path = str_replace('{'.$name.'}', rawurlencode((string) $value), $path),
                'query' => $query[$name] = $value,
                'header' => $headers[$name] = (string) $value,
                default => null,
            };
        }

        if (str_contains($path, '{')) {
            throw new RuntimeException('Missing required Svix path parameter.');
        }

        foreach ($args as $key => $value) {
            if (isset($consumed[$key])) {
                continue;
            }

            if (($definition['request_body'] ?? false) === true) {
                $payload[$key] = $value;
            } else {
                $query[$key] = $value;
            }
        }

        return [$path, $query, $payload, $headers];
    }

    /**
     * Normalize arbitrary header values into string headers.
     *
     * @param  array<string, mixed>  $headers  Header values supplied by a tool caller.
     * @return array<string, string>
     */
    private function stringHeaders(array $headers): array
    {
        $normalized = [];
        foreach ($headers as $name => $value) {
            if (is_scalar($value)) {
                $normalized[(string) $name] = (string) $value;
            }
        }

        return $normalized;
    }

    /**
     * Dispatch an authenticated Svix request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $payload  JSON body fields.
     * @param  array<string, string>  $headers  Additional HTTP headers.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $payload = [], array $headers = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $payload, $headers);

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to the Svix API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $payload  JSON body fields.
     * @param  array<string, string>  $headers  Additional HTTP headers.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $payload = [], array $headers = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Svix authentication token is not configured.');
        }

        $options = [];
        if ($query !== []) {
            $options['query'] = $query;
        }
        if ($payload !== []) {
            $options['json'] = $payload;
        }

        try {
            $response = Http::withToken($this->authToken)
                ->acceptJson()
                ->withHeaders($headers)
                ->timeout(30)
                ->send(strtoupper($method), $this->baseUrl.$path, $options);
        } catch (\Throwable $e) {
            Log::error("Svix API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Svix API: '.$e->getMessage());
        }

        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $response;
    }

    /**
     * Throw a normalized Svix API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) data_get($json, 'detail', data_get($json, 'error.message', data_get($json, 'message', '')))
            : trim($response->body());

        Log::error("Svix API error: {$method} {$path}", [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        throw new RuntimeException('Svix API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Svix responses.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '' || $body === 'null') {
            return ['success' => true, 'status' => $response->status()];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['value' => $body, 'status' => $response->status()];
    }
}
