<?php

namespace OpenCompany\Integrations\Braintrust;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Braintrust REST API.
 *
 * Handles data-plane base URLs, bearer authentication, JSON request dispatch,
 * response parsing, and API error normalization for all Braintrust tools.
 */
class BraintrustService
{
    /**
     * @param  string  $apiKey  Braintrust API key.
     * @param  string  $baseUrl  Braintrust data-plane API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.braintrust.dev',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Execute a Braintrust REST operation.
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

        return $response->json() ?? ['body' => $response->body()];
    }

    /**
     * Perform a raw HTTP request against Braintrust.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Braintrust API key is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120);

            $url = $this->baseUrl . $path;
            $method = strtoupper($method);
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

                Log::error("Braintrust API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Braintrust API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Braintrust API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Braintrust API: {$e->getMessage()}");
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
