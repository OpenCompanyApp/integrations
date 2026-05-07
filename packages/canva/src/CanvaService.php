<?php

namespace OpenCompany\Integrations\Canva;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Canva Connect API.
 *
 * Handles official operation lookup, authentication, parameter mapping,
 * request dispatch, and normalized API error handling.
 */
class CanvaService
{
    private const DEFAULT_BASE_URL = 'https://api.canva.com/rest';

    /**
     * @param  string  $accessToken  OAuth bearer access token for user-scoped Canva Connect operations.
     * @param  string  $baseUrl  Canva Connect REST base URL.
     * @param  string  $clientId  Optional OAuth client ID for token management operations.
     * @param  string  $clientSecret  Optional OAuth client secret for token management operations.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
        private string $clientId = '',
        private string $clientSecret = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether any Canva credentials are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->accessToken) !== '' || ($this->clientId !== '' && $this->clientSecret !== '');
    }

    /**
     * Return the official Canva Connect operation map.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return CanvaOperations::all();
    }

    /**
     * Return metadata for one Canva operation by tool slug or OpenAPI operation ID.
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

        throw new RuntimeException("Unsupported Canva operation: {$operation}");
    }

    /**
     * Execute an official Canva Connect operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        [$path, $query, $headers, $payload, $body] = $this->shapeRequest($definition, $args);

        return $this->request(
            method: (string) $definition['method'],
            path: $path,
            query: $query,
            headers: $headers,
            payload: $payload,
            body: $body,
            contentType: $definition['content_type'] ?? null,
            auth: (string) ($definition['auth'] ?? 'bearer'),
        );
    }

    /**
     * Shape tool arguments into path, query, header, and body data.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array{0: string, 1: array<string, mixed>, 2: array<string, mixed>, 3: array<string, mixed>, 4: string|null}
     */
    private function shapeRequest(array $definition, array $args): array
    {
        $path = (string) $definition['path'];
        $query = isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
        $headers = isset($args['headers']) && is_array($args['headers']) ? $args['headers'] : [];
        $payload = isset($args['payload']) && is_array($args['payload']) ? $args['payload'] : [];
        $consumed = ['query' => true, 'headers' => true, 'payload' => true, 'body' => true];

        foreach ($definition['parameters'] as $parameter) {
            $param = (string) $parameter['param'];
            $source = (string) $parameter['source'];
            $value = $args[$param] ?? null;
            $consumed[$param] = true;

            if ($value === null && $source === 'query') {
                $value = $query[$param] ?? $query[$parameter['name']] ?? null;
            }

            if ($value === null && $source === 'header') {
                $value = $headers[$param] ?? $headers[$parameter['name']] ?? null;
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
            } elseif ($source === 'header') {
                $headers[$parameter['name']] = is_array($value) ? json_encode($value) : $value;
            }
        }

        if (str_contains($path, '{')) {
            throw new RuntimeException('Missing required Canva path parameter.');
        }

        if (($definition['request_body'] ?? false) === true) {
            foreach ($args as $key => $value) {
                if (!isset($consumed[$key])) {
                    $payload[$key] = $value;
                }
            }

            if (($definition['request_body_required'] ?? false) && empty($payload) && (($args['body'] ?? '') === '')) {
                throw new RuntimeException('payload is required.');
            }
        }

        $body = isset($args['body']) ? (string) $args['body'] : null;

        return [$path, $query, $headers, $payload, $body];
    }

    /**
     * Dispatch an HTTP request to Canva.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Header values.
     * @param  array<string, mixed>  $payload  JSON or form body values.
     * @return array<string, mixed>
     */
    private function request(
        string $method,
        string $path,
        array $query = [],
        array $headers = [],
        array $payload = [],
        ?string $body = null,
        ?string $contentType = null,
        string $auth = 'bearer',
    ): array {
        $response = $this->rawRequest($method, $path, $query, $headers, $payload, $body, $contentType, $auth);

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to Canva.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Header values.
     * @param  array<string, mixed>  $payload  JSON or form body values.
     *
     * @throws RuntimeException
     */
    private function rawRequest(
        string $method,
        string $path,
        array $query = [],
        array $headers = [],
        array $payload = [],
        ?string $body = null,
        ?string $contentType = null,
        string $auth = 'bearer',
    ): Response {
        $http = Http::acceptJson()->timeout(30)->withHeaders($headers);

        if ($auth === 'bearer') {
            if (trim($this->accessToken) === '') {
                throw new RuntimeException('Canva access token is not configured.');
            }

            $http = $http->withToken($this->accessToken);
        } elseif ($auth === 'basic_or_body' && $this->clientId !== '' && $this->clientSecret !== '') {
            $http = $http->withBasicAuth($this->clientId, $this->clientSecret);
        }

        $options = [];
        if ($query !== []) {
            $options['query'] = $query;
        }

        if ($contentType === 'application/x-www-form-urlencoded') {
            $options['form_params'] = $payload;
        } elseif ($contentType === 'application/octet-stream') {
            $options['body'] = $body ?? '';
            $http = $http->withHeaders(['Content-Type' => 'application/octet-stream']);
        } elseif ($payload !== []) {
            $options['json'] = $payload;
        }

        try {
            $response = $http->send(strtoupper($method), $this->baseUrl.$path, $options);
        } catch (\Throwable $e) {
            Log::error("Canva API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Canva API: '.$e->getMessage());
        }

        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $response;
    }

    /**
     * Throw a normalized Canva API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) ($json['error_description'] ?? $json['error'] ?? $json['message'] ?? '')
            : trim($response->body());

        Log::error("Canva API error: {$method} {$path}", [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        throw new RuntimeException('Canva API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON or empty Canva responses.
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
