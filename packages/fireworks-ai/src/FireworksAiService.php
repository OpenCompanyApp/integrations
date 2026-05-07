<?php

namespace OpenCompany\Integrations\FireworksAi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Fireworks AI REST and inference APIs.
 *
 * Handles bearer authentication, configurable API roots, JSON dispatch,
 * response parsing, and API error logging for all Fireworks AI tools.
 */
class FireworksAiService
{
    /**
     * @param  string  $apiKey  Fireworks API key.
     * @param  string  $baseUrl  Fireworks API root URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.fireworks.ai',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Execute a Fireworks API operation.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

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
     * Perform a raw JSON HTTP request.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Fireworks AI API key is not configured.');
        }

        try {
            $url = $this->baseUrl . $path;
            $method = strtoupper($method);
            $http = Http::withToken($this->apiKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(180);

            $response = match ($method) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($this->urlWithQuery($url, $query), $body),
                'PUT' => $http->put($this->urlWithQuery($url, $query), $body),
                'PATCH' => $http->patch($this->urlWithQuery($url, $query), $body),
                'DELETE' => $http->delete($this->urlWithQuery($url, $query), $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error')
                    ?? $response->json('message')
                    ?? $response->body();

                Log::error("Fireworks AI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Fireworks AI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Fireworks AI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Fireworks AI API: {$e->getMessage()}");
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
