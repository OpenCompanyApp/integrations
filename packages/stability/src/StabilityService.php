<?php

namespace OpenCompany\Integrations\Stability;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Stability AI platform API.
 *
 * Handles bearer-token authentication, multipart image requests, JSON account
 * calls, generated binary responses, and API error normalization.
 */
class StabilityService
{
    /**
     * @param  string  $apiKey  Stability AI API key.
     * @param  string  $baseUrl  Stability AI API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.stability.ai',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has a usable API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Execute one Stability API operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from a tool class.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function executeOperation(array $operation, array $args = []): array
    {
        $path = (string) $operation['path'];
        $query = [];
        $fields = [];
        $files = [];

        foreach (($operation['path_params'] ?? []) as $name) {
            $value = $this->requireString($args, (string) $name);
            $path = str_replace('{' . $name . '}', rawurlencode($value), $path);
        }

        foreach (($operation['query_params'] ?? []) as $name) {
            if (array_key_exists((string) $name, $args) && $args[(string) $name] !== null && $args[(string) $name] !== '') {
                $query[(string) $name] = $args[(string) $name];
            }
        }

        foreach (($operation['body_params'] ?? []) as $name) {
            if (array_key_exists((string) $name, $args) && $args[(string) $name] !== null && $args[(string) $name] !== '') {
                $fields[(string) $name] = $args[(string) $name];
            }
        }

        foreach (($operation['file_params'] ?? []) as $name) {
            if (array_key_exists((string) $name, $args) && $args[(string) $name] !== null && $args[(string) $name] !== '') {
                $files[(string) $name] = $args[(string) $name];
            }
        }

        foreach (($operation['required'] ?? []) as $name) {
            if (!array_key_exists((string) $name, $args) || $args[(string) $name] === null || $args[(string) $name] === '') {
                throw new \RuntimeException((string) $name . ' is required.');
            }
        }

        return $this->request(
            method: (string) $operation['method'],
            path: $path,
            query: $query,
            fields: $fields,
            files: $files,
            accept: (string) ($args['accept'] ?? $operation['accept'] ?? 'application/json'),
        );
    }

    /**
     * Make an authenticated Stability API request.
     *
     * @param  array<string, mixed>  $query  Query-string values.
     * @param  array<string, mixed>  $fields  JSON or multipart scalar fields.
     * @param  array<string, mixed>  $files  Multipart file fields.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $fields = [], array $files = [], string $accept = 'application/json'): array
    {
        $response = $this->rawRequest($method, $path, $query, $fields, $files, $accept);

        if ($response->status() === 204) {
            return [];
        }

        $contentType = (string) $response->header('Content-Type');
        if (str_contains($contentType, 'json')) {
            return $response->json() ?? [];
        }

        return [
            'content_type' => $contentType,
            'body_base64' => base64_encode($response->body()),
            'finish_reason' => $response->header('finish-reason'),
            'seed' => $response->header('seed'),
        ];
    }

    /**
     * Dispatch the raw HTTP request.
     *
     * @param  array<string, mixed>  $query  Query-string values.
     * @param  array<string, mixed>  $fields  JSON or multipart scalar fields.
     * @param  array<string, mixed>  $files  Multipart file fields.
     */
    private function rawRequest(string $method, string $path, array $query, array $fields, array $files, string $accept): Response
    {
        if ($this->apiKey === '') {
            throw new \RuntimeException('Stability AI API key is not configured.');
        }

        $url = $this->baseUrl . $path;
        if ($query !== []) {
            $url .= '?' . http_build_query($query);
        }

        try {
            $http = Http::withToken($this->apiKey)
                ->accept($accept)
                ->timeout(180);

            foreach ($files as $name => $value) {
                $content = $value;
                $filename = (string) $name;

                if (is_array($value)) {
                    $content = $value['content'] ?? '';
                    $filename = (string) ($value['filename'] ?? $filename);
                }

                if (is_string($content) && is_file($content)) {
                    $filename = basename($content);
                    $content = file_get_contents($content);
                }

                $http = $http->attach((string) $name, (string) $content, $filename);
            }

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $files !== [] ? $http->post($url, $this->stringifyMultipartFields($fields)) : $http->asJson()->post($url, $fields),
                default => throw new \RuntimeException("Unsupported Stability AI HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('errors') ?? $response->body();
                Log::error("Stability AI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Stability AI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Stability AI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Stability AI API: {$e->getMessage()}");
        }
    }

    /**
     * Convert arrays and booleans to multipart-safe scalar values.
     *
     * @param  array<string, mixed>  $fields  Request fields.
     * @return array<string, mixed>
     */
    private function stringifyMultipartFields(array $fields): array
    {
        foreach ($fields as $key => $value) {
            if (is_array($value)) {
                $fields[$key] = json_encode($value);
            } elseif (is_bool($value)) {
                $fields[$key] = $value ? 'true' : 'false';
            }
        }

        return $fields;
    }

    /**
     * Read a required string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireString(array $args, string $key): string
    {
        $value = $args[$key] ?? null;
        if (!is_string($value) || trim($value) === '') {
            throw new \RuntimeException("{$key} is required.");
        }

        return $value;
    }
}
