<?php

namespace OpenCompany\Integrations\Courier;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Courier API.
 *
 * Handles official operation lookup, bearer authentication, parameter mapping,
 * request dispatch, and normalized API error handling.
 */
class CourierService
{
    /**
     * @param  string  $apiKey  Courier API key.
     * @param  string  $baseUrl  Courier API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.courier.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: 'https://api.courier.com', '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Return the official Courier operation map.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return CourierOperations::all();
    }

    /**
     * Return metadata for one Courier operation by tool slug or operation ID.
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

        throw new RuntimeException("Unsupported Courier operation: {$operation}");
    }

    /**
     * Execute an official Courier operation.
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
            $param = (string) $parameter['param'];
            $source = (string) $parameter['source'];
            $value = $args[$param] ?? null;
            $consumed[$param] = true;

            if ($value === null && $source === 'query') {
                $value = $query[$param] ?? $query[$parameter['name']] ?? null;
            }

            if (($parameter['required'] ?? false) && ($value === null || $value === '')) {
                throw new RuntimeException($param.' is required.');
            }

            if ($value === null || $value === '') {
                continue;
            }

            if ($source === 'path') {
                $path = str_replace('{'.$parameter['name'].'}', rawurlencode((string) $value), $path);
            } elseif ($source === 'query') {
                $query[$parameter['name']] = $value;
            }
        }

        if (str_contains($path, '{')) {
            throw new RuntimeException('Missing required Courier path parameter.');
        }

        if (($definition['request_body'] ?? false) === true) {
            foreach ($args as $key => $value) {
                if (!isset($consumed[$key])) {
                    $payload[$key] = $value;
                }
            }

            if (($definition['request_body_required'] ?? false) && empty($payload)) {
                throw new RuntimeException('payload is required.');
            }

            foreach (($definition['request_required_fields'] ?? []) as $field) {
                if (($payload[$field] ?? null) === null || $payload[$field] === '') {
                    throw new RuntimeException($field.' is required in payload.');
                }
            }
        }

        return [$path, $query, $payload];
    }

    /**
     * Make an API request and return parsed JSON.
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
     * Make a raw HTTP request to the Courier API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $payload  JSON body fields.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $payload = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Courier API key is not configured.');
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
            Log::error("Courier API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Courier API: '.$e->getMessage());
        }

        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $response;
    }

    /**
     * Throw a normalized Courier API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) ($json['message'] ?? $json['error'] ?? $json['type'] ?? '')
            : trim($response->body());

        Log::error("Courier API error: {$method} {$path}", [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        throw new RuntimeException('Courier API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Courier responses.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '') {
            return ['success' => true];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['value' => $body];
    }
}
