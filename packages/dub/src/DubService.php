<?php

namespace OpenCompany\Integrations\Dub;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Dub API.
 *
 * Handles official operation lookup, bearer authentication, request shaping,
 * response parsing, and normalized API error handling.
 */
class DubService
{
    private const DEFAULT_BASE_URL = 'https://api.dub.co';

    /**
     * @param  string  $accessToken  Dub API bearer token.
     * @param  string  $baseUrl  Dub API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return trim($this->accessToken) !== '';
    }

    /**
     * Return the official Dub operation map.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return DubOperations::all();
    }

    /**
     * Return metadata for one Dub operation by tool slug or operation key.
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

        throw new RuntimeException("Unsupported Dub operation: {$operation}");
    }

    /**
     * Execute an official Dub API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        [$path, $query, $payload] = $this->shapeRequest($definition, $args);

        return $this->request(
            method: (string) $definition['method'],
            path: $path,
            query: $query,
            payload: $payload,
        );
    }

    /**
     * Shape tool arguments into path, query, and JSON body data.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array{0: string, 1: array<string, mixed>, 2: array<string, mixed>}
     */
    private function shapeRequest(array $definition, array $args): array
    {
        $path = (string) $definition['path'];
        $query = isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
        $payload = isset($args['payload']) && is_array($args['payload']) ? $args['payload'] : [];
        $consumed = ['query' => true, 'payload' => true];

        foreach ($definition['parameters'] as $parameter) {
            $name = (string) $parameter['name'];
            $param = (string) $parameter['param'];
            $value = $args[$param] ?? $args[$name] ?? null;
            $consumed[$param] = true;
            $consumed[$name] = true;

            if (($parameter['required'] ?? false) && ($value === null || $value === '')) {
                throw new RuntimeException($param.' is required.');
            }

            if ($value !== null && $value !== '') {
                $path = str_replace('{'.$name.'}', rawurlencode((string) $value), $path);
            }
        }

        if (str_contains($path, '{')) {
            throw new RuntimeException('Missing required Dub path parameter.');
        }

        if (($definition['request_body'] ?? false) === true) {
            foreach ($args as $key => $value) {
                if (!isset($consumed[$key])) {
                    $payload[$key] = $value;
                }
            }
        } else {
            foreach ($args as $key => $value) {
                if (!isset($consumed[$key])) {
                    $query[$key] = $value;
                }
            }
        }

        return [$path, $query, $payload];
    }

    /**
     * Dispatch an authenticated Dub request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $payload  JSON body fields.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $payload = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $payload);

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to the Dub API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $payload  JSON body fields.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $payload = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Dub access token is not configured.');
        }

        $options = [];
        if ($query !== []) {
            $options['query'] = $query;
        }
        if ($payload !== []) {
            $options['json'] = $payload;
        }

        try {
            $response = Http::withToken($this->accessToken)
                ->acceptJson()
                ->timeout(30)
                ->send(strtoupper($method), $this->baseUrl.$path, $options);
        } catch (\Throwable $e) {
            Log::error("Dub API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Dub API: '.$e->getMessage());
        }

        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $response;
    }

    /**
     * Throw a normalized Dub API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) data_get($json, 'error.message', data_get($json, 'message', data_get($json, 'error', '')))
            : trim($response->body());

        Log::error("Dub API error: {$method} {$path}", [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        throw new RuntimeException('Dub API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Dub responses.
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
