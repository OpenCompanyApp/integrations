<?php

namespace OpenCompany\Integrations\Autopilot;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Autopilot REST API.
 *
 * Handles official API Blueprint operation lookup, documented API-key header
 * authentication, request shaping, response parsing, and API error handling.
 */
class AutopilotService
{
    private const DEFAULT_BASE_URL = 'https://api.autopilothq.com';

    /**
     * @param  string  $apiKey  Autopilot API key sent in the autopilotapikey header.
     * @param  string  $baseUrl  Autopilot API host URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->normalizeBaseUrl($this->baseUrl), '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Return the official Autopilot operation map.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return AutopilotOperations::all();
    }

    /**
     * Return metadata for one Autopilot operation by tool slug or operation key.
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

        throw new RuntimeException("Unsupported Autopilot operation: {$operation}");
    }

    /**
     * Execute an official Autopilot API operation.
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
            throw new RuntimeException('Missing required Autopilot path parameter.');
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
     * Normalize legacy base URLs that include /v1.
     */
    private function normalizeBaseUrl(string $baseUrl): string
    {
        $baseUrl = rtrim($baseUrl ?: self::DEFAULT_BASE_URL, '/');

        return str_ends_with($baseUrl, '/v1') ? substr($baseUrl, 0, -3) : $baseUrl;
    }

    /**
     * Dispatch an authenticated Autopilot request.
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
     * Make a raw HTTP request to the Autopilot API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $payload  JSON body fields.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $payload = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Autopilot API key is not configured.');
        }

        $options = [];
        if ($query !== []) {
            $options['query'] = $query;
        }
        if ($payload !== []) {
            $options['json'] = $payload;
        }

        try {
            $response = Http::withHeaders([
                'autopilotapikey' => $this->apiKey,
                'autopilot-sdk-version' => '2.0',
            ])
                ->acceptJson()
                ->timeout(30)
                ->send(strtoupper($method), $this->baseUrl.$path, $options);
        } catch (\Throwable $e) {
            Log::error("Autopilot API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Autopilot API: '.$e->getMessage());
        }

        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $response;
    }

    /**
     * Throw a normalized Autopilot API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) data_get($json, 'message', data_get($json, 'error', ''))
            : trim($response->body());

        Log::error("Autopilot API error: {$method} {$path}", [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        throw new RuntimeException('Autopilot API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Autopilot responses.
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
