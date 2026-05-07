<?php

namespace OpenCompany\Integrations\CustomerIO;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Customer.io's App, Track, and Pipelines APIs.
 *
 * Handles official operation lookup, authentication, request shaping, and
 * normalized API error handling for all generated Customer.io tools.
 */
class CustomerIOService
{
    private const DEFAULT_APP_URL = 'https://api.customer.io';

    private const DEFAULT_TRACK_URL = 'https://track.customer.io';

    private const DEFAULT_PIPELINES_URL = 'https://cdp.customer.io/v1';

    /**
     * @param  string  $apiKey  Customer.io App API bearer token.
     * @param  string  $baseUrl  Customer.io App API base URL.
     * @param  string  $siteId  Customer.io Track API site ID for basic auth.
     * @param  string  $trackApiKey  Customer.io Track API key for basic auth.
     * @param  string  $trackBaseUrl  Customer.io Track API base URL.
     * @param  string  $pipelinesApiKey  Customer.io Pipelines API key for basic auth.
     * @param  string  $pipelinesBaseUrl  Customer.io Pipelines API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = self::DEFAULT_APP_URL,
        private string $siteId = '',
        private string $trackApiKey = '',
        private string $trackBaseUrl = self::DEFAULT_TRACK_URL,
        private string $pipelinesApiKey = '',
        private string $pipelinesBaseUrl = self::DEFAULT_PIPELINES_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_APP_URL, '/');
        $this->trackBaseUrl = rtrim($this->trackBaseUrl ?: self::DEFAULT_TRACK_URL, '/');
        $this->pipelinesBaseUrl = rtrim($this->pipelinesBaseUrl ?: self::DEFAULT_PIPELINES_URL, '/');
    }

    /**
     * Check whether any Customer.io credential set is available.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== ''
            || (trim($this->siteId) !== '' && trim($this->trackApiKey) !== '')
            || trim($this->pipelinesApiKey) !== '';
    }

    /**
     * Return the official Customer.io operation map.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return CustomerIOOperations::all();
    }

    /**
     * Return metadata for one Customer.io operation by tool slug or OpenAPI operation ID.
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

        throw new RuntimeException("Unsupported Customer.io operation: {$operation}");
    }

    /**
     * Execute an official Customer.io API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        [$path, $query, $headers, $payload] = $this->shapeRequest($definition, $args);

        return $this->request(
            method: (string) $definition['method'],
            path: $path,
            query: $query,
            headers: $headers,
            payload: $payload,
            contentType: $definition['content_type'] ?? null,
            auth: (string) ($definition['auth'] ?? 'bearer'),
        );
    }

    /**
     * Shape tool arguments into path, query, header, and body data.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array{0: string, 1: array<string, mixed>, 2: array<string, mixed>, 3: array<string, mixed>}
     */
    private function shapeRequest(array $definition, array $args): array
    {
        $path = (string) $definition['path'];
        $query = isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
        $headers = isset($args['headers']) && is_array($args['headers']) ? $args['headers'] : [];
        $payload = isset($args['payload']) && is_array($args['payload']) ? $args['payload'] : [];
        $consumed = ['query' => true, 'headers' => true, 'payload' => true];

        foreach ($definition['parameters'] as $parameter) {
            $source = (string) ($parameter['source'] ?? '');
            $name = (string) ($parameter['name'] ?? '');
            $param = (string) ($parameter['param'] ?? $name);

            if ($source === '' || $name === '' || $param === '') {
                continue;
            }

            $value = $args[$param] ?? null;
            $consumed[$param] = true;

            if ($value === null && $source === 'query') {
                $value = $query[$param] ?? $query[$name] ?? null;
            }

            if ($value === null && $source === 'header') {
                $value = $headers[$param] ?? $headers[$name] ?? null;
            }

            if (($parameter['required'] ?? false) && ($value === null || $value === '')) {
                throw new RuntimeException($param.' is required.');
            }

            if ($value === null || $value === '') {
                continue;
            }

            if ($source === 'path') {
                $path = str_replace('{'.$name.'}', rawurlencode((string) $value), $path);
            } elseif ($source === 'query') {
                $query[$name] = $value;
            } elseif ($source === 'header') {
                $headers[$name] = is_array($value) ? json_encode($value) : $value;
            }
        }

        $path = $this->fillImplicitPathParameters($path, $args, $consumed);

        if (($definition['request_body'] ?? false) === true) {
            foreach ($args as $key => $value) {
                if (!isset($consumed[$key])) {
                    $payload[$key] = $value;
                }
            }

            foreach ($definition['request_required_fields'] ?? [] as $field) {
                if (!array_key_exists((string) $field, $payload) || $payload[(string) $field] === '') {
                    throw new RuntimeException($field.' is required in payload.');
                }
            }

            if (($definition['request_body_required'] ?? false) && empty($payload)) {
                throw new RuntimeException('payload is required.');
            }
        } else {
            foreach ($args as $key => $value) {
                if (!isset($consumed[$key])) {
                    $query[$key] = $value;
                }
            }
        }

        if (str_contains($path, '{')) {
            throw new RuntimeException('Missing required Customer.io path parameter.');
        }

        return [$path, $query, $headers, $payload];
    }

    /**
     * Fill path placeholders that are present in the OpenAPI path but absent from operation parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<string, bool>  $consumed  Arguments already consumed by explicit parameters.
     */
    private function fillImplicitPathParameters(string $path, array $args, array &$consumed): string
    {
        preg_match_all('/\{([^}]+)\}/', $path, $matches);

        foreach ($matches[1] as $name) {
            $param = $this->snake((string) $name);
            $value = $args[$param] ?? $args[$name] ?? null;
            $consumed[$param] = true;
            $consumed[$name] = true;

            if ($value === null || $value === '') {
                throw new RuntimeException($param.' is required.');
            }

            $path = str_replace('{'.$name.'}', rawurlencode((string) $value), $path);
        }

        return $path;
    }

    /**
     * Dispatch an HTTP request to Customer.io.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Header values.
     * @param  array<string, mixed>  $payload  JSON, form, or multipart body values.
     * @return array<string, mixed>
     */
    private function request(
        string $method,
        string $path,
        array $query = [],
        array $headers = [],
        array $payload = [],
        ?string $contentType = null,
        string $auth = 'bearer',
    ): array {
        $response = $this->rawRequest($method, $path, $query, $headers, $payload, $contentType, $auth);

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to the selected Customer.io API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Header values.
     * @param  array<string, mixed>  $payload  JSON, form, or multipart body values.
     *
     * @throws RuntimeException
     */
    private function rawRequest(
        string $method,
        string $path,
        array $query = [],
        array $headers = [],
        array $payload = [],
        ?string $contentType = null,
        string $auth = 'bearer',
    ): Response {
        [$baseUrl, $http] = $this->httpClient($auth);
        $http = $http->acceptJson()->timeout(30)->withHeaders($headers);

        $options = [];
        if ($query !== []) {
            $options['query'] = $query;
        }

        if ($contentType === 'multipart/form-data') {
            $http = $http->asMultipart();
            $options['multipart'] = $this->multipartPayload($payload);
        } elseif ($payload !== []) {
            $options['json'] = $payload;
        }

        try {
            $response = $http->send(strtoupper($method), $baseUrl.$path, $options);
        } catch (\Throwable $e) {
            Log::error("Customer.io API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Customer.io API: '.$e->getMessage());
        }

        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $response;
    }

    /**
     * Build the authenticated HTTP client for an operation auth type.
     *
     * @return array{0: string, 1: mixed}
     */
    private function httpClient(string $auth): array
    {
        $http = Http::withHeaders([]);

        if ($auth === 'bearer') {
            if (trim($this->apiKey) === '') {
                throw new RuntimeException('Customer.io App API key is not configured.');
            }

            return [$this->baseUrl, $http->withToken($this->apiKey)];
        }

        if ($auth === 'track_basic') {
            if (trim($this->siteId) === '' || trim($this->trackApiKey) === '') {
                throw new RuntimeException('Customer.io Track API site ID and API key are not configured.');
            }

            return [$this->trackBaseUrl, $http->withBasicAuth($this->siteId, $this->trackApiKey)];
        }

        if ($auth === 'pipeline_basic') {
            if (trim($this->pipelinesApiKey) === '') {
                throw new RuntimeException('Customer.io Pipelines API key is not configured.');
            }

            return [$this->pipelinesBaseUrl, $http->withBasicAuth($this->pipelinesApiKey, '')];
        }

        throw new RuntimeException("Unsupported Customer.io auth type: {$auth}");
    }

    /**
     * Shape payload values for Laravel's multipart request option.
     *
     * @param  array<string, mixed>  $payload  Multipart field values.
     * @return list<array{name: string, contents: mixed, filename?: string}>
     */
    private function multipartPayload(array $payload): array
    {
        $parts = [];

        foreach ($payload as $name => $value) {
            if (is_array($value) && array_key_exists('contents', $value)) {
                $part = ['name' => (string) $name, 'contents' => $value['contents']];
                if (isset($value['filename'])) {
                    $part['filename'] = (string) $value['filename'];
                }
                $parts[] = $part;

                continue;
            }

            $parts[] = [
                'name' => (string) $name,
                'contents' => is_array($value) ? json_encode($value) : $value,
            ];
        }

        return $parts;
    }

    /**
     * Throw a normalized Customer.io API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) ($json['error'] ?? $json['message'] ?? $json['detail'] ?? '')
            : trim($response->body());

        Log::error("Customer.io API error: {$method} {$path}", [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        throw new RuntimeException('Customer.io API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Customer.io responses.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '' || $body === 'null') {
            return ['success' => true];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['value' => $body];
    }

    /**
     * Convert OpenAPI path parameter names to tool argument names.
     */
    private function snake(string $value): string
    {
        $value = preg_replace('/([a-z])([A-Z])/', '$1_$2', $value) ?? $value;

        return strtolower(str_replace(['-', '.'], '_', $value));
    }
}
