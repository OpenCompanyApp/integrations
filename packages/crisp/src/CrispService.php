<?php

namespace OpenCompany\Integrations\Crisp;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the official Crisp REST API.
 *
 * Uses the operation surface from node-crisp-api and Crisp's documented
 * token identifier/key authentication with the X-Crisp-Tier header.
 */
class CrispService
{
    private const DEFAULT_BASE_URL = 'https://api.crisp.chat';

    /**
     * @param  string  $identifier  Crisp token identifier.
     * @param  string  $key  Crisp token key.
     * @param  string  $websiteId  Default Crisp website ID for website-scoped operations.
     * @param  string  $tier  Crisp token tier: user, website, or plugin.
     * @param  string  $baseUrl  Crisp REST API host, with or without /v1.
     */
    public function __construct(
        private string $identifier = '',
        private string $key = '',
        private string $websiteId = '',
        private string $tier = 'plugin',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->normalizeBaseUrl($this->baseUrl), '/');
    }

    /**
     * Check whether the service has token credentials.
     */
    public function isConfigured(): bool
    {
        return trim($this->identifier) !== '' && trim($this->key) !== '';
    }

    /**
     * Return the configured default website ID, if any.
     */
    public function getWebsiteId(): string
    {
        return $this->websiteId;
    }

    /**
     * Return the official Crisp operation map.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return CrispOperations::all();
    }

    /**
     * Return metadata for one Crisp operation by tool slug or operation key.
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

        throw new RuntimeException("Unsupported Crisp operation: {$operation}");
    }

    /**
     * Execute an official Crisp REST API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        [$path, $query, $payload] = $this->shapeRequest($definition, $args);

        return $this->request((string) $definition['method'], $path, $query, $payload);
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
            $name = (string) $parameter['name'];
            $location = (string) $parameter['in'];
            $value = $args[$param] ?? $args[$name] ?? null;
            $consumed[$param] = true;
            $consumed[$name] = true;

            if ($location === 'path' && $name === 'websiteID' && ($value === null || $value === '')) {
                $value = $this->websiteId;
            }
            if ($location === 'path' && $name === 'pageNumber' && ($value === null || $value === '')) {
                $value = 1;
            }

            if (($parameter['required'] ?? false) && ($value === null || $value === '')) {
                throw new RuntimeException($param.' is required.');
            }
            if ($value === null || $value === '') {
                continue;
            }

            if ($location === 'path') {
                $path = str_replace('{'.$name.'}', rawurlencode((string) $value), $path);
            } elseif ($location === 'query') {
                if (is_array($value) && in_array($param, ['options', 'query', 'search_query'], true)) {
                    $query = array_merge($query, $value);
                } else {
                    $query[$name] = $value;
                }
            } elseif ($location === 'body') {
                if (is_array($value) && in_array($param, ['payload', 'message', 'settings', 'profile', 'campaign', 'template', 'article', 'category', 'section', 'inbox', 'operation', 'people', 'data'], true)) {
                    $payload = array_merge($payload, $value);
                } else {
                    $payload[$name] = $value;
                }
            }
        }

        if (str_contains($path, '{')) {
            throw new RuntimeException('Missing required Crisp path parameter.');
        }

        foreach ($args as $key => $value) {
            if (isset($consumed[$key])) {
                continue;
            }
            if (($definition['type'] ?? 'read') === 'write') {
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
     * Dispatch an authenticated Crisp request.
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
     * Make a raw HTTP request to the Crisp API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $payload  JSON body fields.
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $payload = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Crisp token identifier and token key are required.');
        }

        $options = [];
        if ($query !== []) {
            $options['query'] = $this->encodeQuery($query);
        }
        if ($payload !== []) {
            $options['json'] = $payload;
        }

        try {
            $response = Http::withHeaders(['X-Crisp-Tier' => $this->tier ?: 'plugin'])
                ->withBasicAuth($this->identifier, $this->key)
                ->acceptJson()
                ->timeout(30)
                ->send(strtoupper($method), $this->baseUrl.$path, $options);
        } catch (\Throwable $e) {
            Log::error("Crisp API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Crisp API: '.$e->getMessage());
        }

        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $response;
    }

    /**
     * Match node-crisp-api query encoding for object values.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function encodeQuery(array $query): array
    {
        foreach ($query as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $query[$key] = json_encode($value);
            }
        }

        return $query;
    }

    /**
     * Throw a normalized Crisp API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) data_get($json, 'reason', data_get($json, 'message', data_get($json, 'error', '')))
            : trim($response->body());

        Log::error("Crisp API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Crisp API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Crisp responses.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        if ($response->body() === '') {
            return ['success' => true];
        }
        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body()];
    }
}
