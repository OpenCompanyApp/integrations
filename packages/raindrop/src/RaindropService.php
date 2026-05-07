<?php

namespace OpenCompany\Integrations\Raindrop;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Raindrop.io REST API.
 *
 * Handles official operation lookup, bearer authentication, request shaping,
 * response parsing, and normalized API errors.
 */
class RaindropService
{
    private const DEFAULT_BASE_URL = 'https://api.raindrop.io/rest/v1';

    /**
     * @param  string  $accessToken  Raindrop.io OAuth access token.
     * @param  string  $baseUrl  Raindrop.io REST API base URL.
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
     * Return the official Raindrop.io operation map.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return RaindropOperations::all();
    }

    /**
     * Return metadata for one Raindrop.io operation by tool slug or operation key.
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

        throw new RuntimeException("Unsupported Raindrop.io operation: {$operation}");
    }

    /**
     * Execute an official Raindrop.io API operation.
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
            contentType: $definition['content_type'] ?? null,
        );
    }

    /**
     * Shape tool arguments into path, query, and body data.
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
            } elseif (($parameter['required'] ?? false) === false) {
                $path = str_replace('/{'.$name.'}', '', $path);
                $path = str_replace('{'.$name.'}', '', $path);
            }
        }

        if (str_contains($path, '{')) {
            throw new RuntimeException('Missing required Raindrop.io path parameter.');
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
     * Dispatch an authenticated Raindrop.io request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $payload  JSON or multipart body fields.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $payload = [], ?string $contentType = null): array
    {
        $response = $this->rawRequest($method, $path, $query, $payload, $contentType);

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to the Raindrop.io API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $payload  JSON or multipart body fields.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $payload = [], ?string $contentType = null): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Raindrop.io access token is not configured.');
        }

        $http = Http::withToken($this->accessToken)->acceptJson()->timeout(30);
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
            $response = $http->send(strtoupper($method), $this->baseUrl.$path, $options);
        } catch (\Throwable $e) {
            Log::error("Raindrop.io API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Raindrop.io API: '.$e->getMessage());
        }

        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $response;
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
     * Throw a normalized Raindrop.io API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) ($json['errorMessage'] ?? $json['error'] ?? $json['message'] ?? '')
            : trim($response->body());

        Log::error("Raindrop.io API error: {$method} {$path}", [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        throw new RuntimeException('Raindrop.io API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Raindrop.io responses.
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
