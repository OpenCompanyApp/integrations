<?php

namespace OpenCompany\Integrations\Cerebras;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Cerebras Inference and Management APIs.
 *
 * Handles bearer authentication, JSON and multipart dispatch, absolute metric
 * URLs, response parsing, and API error logging for all Cerebras tools.
 */
class CerebrasService
{
    /**
     * @param  string  $apiKey  Cerebras API key.
     * @param  string  $baseUrl  Cerebras API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.cerebras.ai',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Execute a Cerebras API operation.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON body or multipart fields.
     * @return array<string, mixed>
     */
    public function request(string $method, string $path, array $query = [], array $body = [], ?string $filePath = null, string $fileField = 'file'): array
    {
        $response = $this->rawRequest($method, $path, $query, $body, $filePath, $fileField);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        $json = $response->json();

        if (is_array($json)) {
            return $json;
        }

        return [
            'body' => $response->body(),
            'content_type' => $response->header('Content-Type'),
            'status' => $response->status(),
        ];
    }

    /**
     * Perform a raw Cerebras HTTP request.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON body or multipart fields.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = [], ?string $filePath = null, string $fileField = 'file'): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Cerebras API key is not configured.');
        }

        try {
            $url = str_starts_with($path, 'http://') || str_starts_with($path, 'https://')
                ? $path
                : $this->baseUrl . $path;
            $method = strtoupper($method);
            $http = Http::withToken($this->apiKey)->timeout(180);

            if ($filePath !== null) {
                if (!is_file($filePath) || !is_readable($filePath)) {
                    throw new RuntimeException("Upload file is not readable: {$filePath}");
                }

                $http = $http->attach($fileField, fopen($filePath, 'r'), basename($filePath));
                $response = match ($method) {
                    'POST' => $http->post($this->urlWithQuery($url, $query), $body),
                    default => throw new RuntimeException("Multipart uploads only support POST, got {$method}."),
                };
            } else {
                $http = $http->withHeaders(['Content-Type' => 'application/json']);
                $response = match ($method) {
                    'GET' => $http->get($url, $query),
                    'POST' => $http->post($this->urlWithQuery($url, $query), $body),
                    'PATCH' => $http->patch($this->urlWithQuery($url, $query), $body),
                    'DELETE' => $http->delete($this->urlWithQuery($url, $query), $body),
                    default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
                };
            }

            if (!$response->successful()) {
                $error = $response->json('error')
                    ?? $response->json('message')
                    ?? $response->body();

                Log::error("Cerebras API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Cerebras API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Cerebras API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Cerebras API: {$e->getMessage()}");
        }
    }

    /**
     * Append query parameters for non-GET requests.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        if ($query === []) {
            return $url;
        }

        return $url . '?' . http_build_query($query);
    }
}
