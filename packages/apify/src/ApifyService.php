<?php

namespace OpenCompany\Integrations\Apify;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the official Apify API.
 *
 * Handles Bearer authentication, OpenAPI operation request mapping, and
 * response parsing for generated operation tools.
 */
class ApifyService
{
    /**
     * @param  string  $apiToken  Apify API token for Bearer authentication.
     * @param  string  $baseUrl  Apify API base URL. Supports either https://api.apify.com or the legacy https://api.apify.com/v2 value.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.apify.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl !== '' ? $this->baseUrl : 'https://api.apify.com', '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiToken !== '';
    }

    /**
     * Return all official Apify operations exposed by this integration.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return ApifyOperations::all();
    }

    /**
     * Return one operation definition by slug.
     *
     * @return array<string, mixed>
     */
    public function operation(string $operation): array
    {
        foreach (self::operations() as $definition) {
            if ($definition['slug'] === $operation) {
                return $definition;
            }
        }

        throw new \RuntimeException("Unsupported Apify operation: {$operation}");
    }

    /**
     * Execute an official Apify operation using normalized tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        [$path, $pathArgs] = $this->preparePath($definition, $args);
        $query = $this->prepareQuery($definition, $args);
        foreach ($pathArgs as $param) {
            unset($query[$param]);
        }
        $body = $this->prepareBody($definition, $args);

        return $this->request($definition, $path, $query, $body);
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
            if (($parameter['in'] ?? null) !== 'path') {
                continue;
            }

            $original = (string) $parameter['name'];
            $param = (string) $parameter['param'];
            $value = $args[$param] ?? null;

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
            if (($parameter['in'] ?? null) !== 'query') {
                continue;
            }

            $param = (string) $parameter['param'];
            if (array_key_exists($param, $args)) {
                $query[(string) $parameter['name']] = $args[$param];
            }
        }

        if (isset($args['query']) && is_array($args['query'])) {
            foreach ($args['query'] as $key => $value) {
                $query[(string) $key] = $value;
            }
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
        $bodyParameter = null;
        foreach ($definition['parameters'] as $parameter) {
            if (($parameter['in'] ?? null) === 'body') {
                $bodyParameter = $parameter;
                break;
            }
        }

        if ($bodyParameter === null) {
            return null;
        }

        if (! array_key_exists('body', $args)) {
            if (! ($bodyParameter['required'] ?? false)) {
                return null;
            }

            throw new \RuntimeException("body is required for {$definition['slug']}.");
        }

        if (! is_array($args['body'])) {
            throw new \RuntimeException('body must be an object or array.');
        }

        return $args['body'];
    }

    /**
     * Send an HTTP request and normalize the response for tools.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(array $definition, string $path, array $query = [], array|null $body = null): array
    {
        $response = $this->rawRequest($definition, $path, $query, $body);
        if ($response->status() === 204) {
            return [];
        }

        $contentType = (string) ($response->header('Content-Type') ?? '');
        if (str_contains($contentType, 'application/json') || str_contains($contentType, '+json')) {
            $json = $response->json();

            return is_array($json) ? $json : [];
        }

        return [
            'body' => $response->body(),
            'content_type' => $contentType,
        ];
    }

    /**
     * Send a raw HTTP request to the Apify API.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON body.
     */
    private function rawRequest(array $definition, string $path, array $query = [], array|null $body = null): Response
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Apify API token is not configured.');
        }

        $method = (string) $definition['method'];
        $url = $this->urlFor($path);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->apiToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(60);

            $options = [];
            if ($query !== []) {
                $options['query'] = $query;
            }
            if ($body !== null) {
                $options['json'] = $body;
            }

            $response = $http->send($method, $url, $options);
            if (! $response->successful()) {
                $error = $response->json('error.message') ?? $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Apify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException('Apify API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Apify API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new \RuntimeException("Failed to connect to Apify API: {$e->getMessage()}");
        }
    }

    /**
     * Build a request URL while tolerating the old /v2-suffixed base URL.
     */
    private function urlFor(string $path): string
    {
        if (str_ends_with($this->baseUrl, '/v2') && str_starts_with($path, '/v2/')) {
            return $this->baseUrl.substr($path, 3);
        }

        return $this->baseUrl.$path;
    }
}
