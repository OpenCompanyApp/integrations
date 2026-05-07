<?php

namespace OpenCompany\Integrations\DailyCo;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Daily REST API.
 *
 * Handles official operation lookup, bearer authentication, request shaping,
 * response parsing, and normalized API error handling.
 */
class DailyCoService
{
    private const DEFAULT_BASE_URL = 'https://api.daily.co/v1';

    /**
     * @param  string  $apiKey  Daily API key.
     * @param  string  $baseUrl  Daily REST API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Return the official Daily REST API operation map.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return DailyCoOperations::all();
    }

    /**
     * Return metadata for one Daily operation by tool slug or SDK method name.
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

        throw new RuntimeException("Unsupported Daily.co operation: {$operation}");
    }

    /**
     * Execute an official Daily REST API operation.
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
            throw new RuntimeException('Missing required Daily.co path parameter.');
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

        return [$path, $query, $payload];
    }

    /**
     * Dispatch an authenticated Daily request.
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
     * Make a raw HTTP request to the Daily REST API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $payload  JSON body fields.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $payload = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Daily.co API key is not configured.');
        }

        $options = [];
        if ($query !== []) {
            $options['query'] = $query;
        }
        if ($payload !== []) {
            $options['json'] = $payload;
        }

        try {
            $response = Http::withToken($this->apiKey)
                ->acceptJson()
                ->timeout(30)
                ->send(strtoupper($method), $this->baseUrl.$path, $options);
        } catch (\Throwable $e) {
            Log::error("Daily.co API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Daily.co API: '.$e->getMessage());
        }

        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $response;
    }

    /**
     * Throw a normalized Daily API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) data_get($json, 'error', data_get($json, 'message', ''))
            : trim($response->body());

        Log::error("Daily.co API error: {$method} {$path}", [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        throw new RuntimeException('Daily.co API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Daily responses.
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
