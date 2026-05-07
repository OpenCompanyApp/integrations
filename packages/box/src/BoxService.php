<?php

namespace OpenCompany\Integrations\Box;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the official Box Platform API.
 *
 * Handles Bearer authentication, API and upload hosts, multipart uploads,
 * OpenAPI operation request mapping, and response parsing for generated tools.
 */
class BoxService
{
    /**
     * @param  string  $accessToken  Box API access token.
     * @param  string  $baseUrl  Box API base URL.
     * @param  string  $uploadUrl  Box upload API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.box.com/2.0',
        private string $uploadUrl = 'https://upload.box.com/api/2.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl !== '' ? $this->baseUrl : 'https://api.box.com/2.0', '/');
        $this->uploadUrl = rtrim($this->uploadUrl !== '' ? $this->uploadUrl : 'https://upload.box.com/api/2.0', '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Return all official Box operations exposed by this integration.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return BoxOperations::all();
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

        throw new \RuntimeException("Unsupported Box operation: {$operation}");
    }

    /**
     * Execute an official Box operation using normalized tool arguments.
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
     * Build JSON or multipart body for write operations.
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
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON or multipart body.
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
     * Send a raw HTTP request to the Box API.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON or multipart body.
     */
    private function rawRequest(array $definition, string $path, array $query = [], array|null $body = null): Response
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Box access token is not configured.');
        }

        $method = (string) $definition['method'];
        $url = $this->urlWithQuery($this->baseUrlFor($definition).$path, $query);
        $bodyContentType = (string) ($definition['body_content_type'] ?? 'application/json');

        try {
            $headers = [
                'Authorization' => 'Bearer '.$this->accessToken,
                'Accept' => 'application/json',
            ];
            if ($bodyContentType !== 'multipart/form-data') {
                $headers['Content-Type'] = $bodyContentType;
            }

            $response = Http::withHeaders($headers)
                ->timeout(120)
                ->send($method, $url, $this->requestOptions($body, $bodyContentType));

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->json('error_description') ?? $response->json('error') ?? $response->body();
                Log::error("Box API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException('Box API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Box API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new \RuntimeException("Failed to connect to Box API: {$e->getMessage()}");
        }
    }

    /**
     * Build request options for JSON or multipart bodies.
     *
     * @param  array<string, mixed>|list<mixed>|null  $body  Request body.
     * @return array<string, mixed>
     */
    private function requestOptions(array|null $body, string $bodyContentType): array
    {
        if ($body === null) {
            return [];
        }

        if ($bodyContentType === 'multipart/form-data') {
            return ['multipart' => $this->multipart($body)];
        }

        return ['json' => $body];
    }

    /**
     * Convert body fields to Laravel multipart format.
     *
     * @param  array<string, mixed>|list<mixed>  $body  Multipart fields.
     * @return list<array<string, mixed>>
     */
    private function multipart(array $body): array
    {
        $parts = [];
        foreach ($body as $name => $contents) {
            $part = ['name' => (string) $name];
            if (is_string($contents) && is_file($contents)) {
                $part['contents'] = fopen($contents, 'r');
                $part['filename'] = basename($contents);
            } else {
                $part['contents'] = is_scalar($contents) ? (string) $contents : json_encode($contents);
            }
            $parts[] = $part;
        }

        return $parts;
    }

    /**
     * Select the API or upload host for an operation.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     */
    private function baseUrlFor(array $definition): string
    {
        return ($definition['base'] ?? 'api') === 'upload' ? $this->uploadUrl : $this->baseUrl;
    }

    /**
     * Append query parameters to a URL.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item === null || $item === '') {
                    continue;
                }
                $parts[] = rawurlencode((string) $key).'='.rawurlencode((string) $item);
            }
        }

        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}
