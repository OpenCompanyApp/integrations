<?php

namespace OpenCompany\Integrations\Beehiiv;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the official beehiiv API v2.
 *
 * Handles authentication, operation request mapping, and response parsing for generated tools.
 */
class BeehiivService
{
    /**
     * @param  string  $apiKey  beehiiv API key for Bearer token authentication.
     * @param  string  $publicationId  Optional default publication ID for publication-scoped operations.
     * @param  string  $baseUrl  beehiiv API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $publicationId = '',
        private string $baseUrl = 'https://api.beehiiv.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl !== '' ? $this->baseUrl : 'https://api.beehiiv.com/v2', '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    public function getPublicationId(): string
    {
        return $this->publicationId;
    }

    /**
     * Return all official beehiiv operations exposed by this integration.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return BeehiivOperations::all();
    }

    /**
     * Return one operation definition by slug.
     *
     * @return array<string, mixed>
     */
    public function operation(string $operation): array
    {
        foreach (self::operations() as $definition) {
            if ($definition['slug'] === $operation) return $definition;
        }
        throw new \RuntimeException("Unsupported beehiiv operation: {$operation}");
    }

    /**
     * Execute an official beehiiv operation using normalized tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        [$path, $pathArgs] = $this->preparePath($definition, $args);
        $query = $this->prepareQuery($definition, $args);
        foreach ($pathArgs as $param) unset($query[$param]);
        $body = $this->prepareBody($definition, $args);
        return $this->request((string) $definition['method'], $path, $query, $body);
    }

    /**
     * Build request path and replace path variables.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array{0: string, 1: list<string>}
     */
    private function preparePath(array $definition, array $args): array
    {
        $path = (string) $definition['path'];
        $pathArgs = [];
        foreach ($definition['parameters'] as $parameter) {
            if (($parameter['in'] ?? null) !== 'path') continue;
            $original = (string) $parameter['name'];
            $param = (string) $parameter['param'];
            $value = $args[$param] ?? null;
            if ($value === null && strtolower($original) === 'publicationid' && $this->publicationId !== '') {
                $value = $this->publicationId;
            }
            if ($value === null || $value === '') {
                throw new \RuntimeException("{$param} is required for {$definition['slug']}.");
            }
            $path = str_replace('{'.$original.'}', rawurlencode((string) $value), $path);
            $pathArgs[] = $param;
        }
        return [$path, $pathArgs];
    }

    /**
     * Build query parameters.
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
            if (array_key_exists($param, $args)) $query[(string) $parameter['name']] = $args[$param];
        }
        if (isset($args['query']) && is_array($args['query'])) {
            foreach ($args['query'] as $key => $value) $query[(string) $key] = $value;
        }
        return $query;
    }

    /**
     * Build JSON body for write operations.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>|list<mixed>|null
     */
    private function prepareBody(array $definition, array $args): array|null
    {
        if (array_key_exists('body', $args) && is_array($args['body'])) return $args['body'];
        return null;
    }

    /**
     * Send an HTTP request and parse JSON response.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array|null $body = null): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);
        if ($response->status() === 204) return [];
        $json = $response->json();
        return is_array($json) ? $json : [];
    }

    /**
     * Send a raw HTTP request to the beehiiv API.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array|null $body = null): Response
    {
        if (!$this->apiKey) throw new \RuntimeException('beehiiv API key is not configured.');
        $url = $this->baseUrl.$path;
        try {
            $http = Http::withHeaders(['Authorization' => 'Bearer '.$this->apiKey, 'Accept' => 'application/json', 'Content-Type' => 'application/json'])->timeout(30);
            $options = [];
            if ($query !== []) $options['query'] = $query;
            if ($body !== null) $options['json'] = $body;
            $response = $http->send(strtoupper($method), $url, $options);
            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("beehiiv API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new \RuntimeException("beehiiv API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("beehiiv API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to beehiiv API: {$e->getMessage()}");
        }
    }
}