<?php

namespace OpenCompany\Integrations\SparkPost;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * SparkPost API service — handles authenticated HTTP requests to the SparkPost REST API.
 *
 * Uses Bearer token authentication. Base URL defaults to https://api.sparkpost.com/api/v1.
 */
class SparkPostService
{
    /**
     * @param  string  $apiKey  SparkPost API key (Bearer token).
     * @param  string  $baseUrl  Base URL for the SparkPost API (default: https://api.sparkpost.com/api/v1).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.sparkpost.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an API key configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /**
     * List sending domains.
     *
     * @param  int  $limit  Maximum number of domains to return.
     * @return array<string, mixed>
     */
    public function listSendingDomains(int $limit = 100): array
    {
        return $this->request('GET', '/sending-domains', ['limit' => $limit]);
    }

    /**
     * Get a single sending domain by domain name.
     *
     * @param  string  $domain  The domain name to look up.
     * @return array<string, mixed>
     */
    public function getSendingDomain(string $domain): array
    {
        return $this->request('GET', '/sending-domains/' . urlencode($domain));
    }

    /**
     * List email templates.
     *
     * @param  int  $limit  Maximum number of templates to return.
     * @param  int  $offset  Offset for pagination.
     * @return array<string, mixed>
     */
    public function listTemplates(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/templates', ['limit' => $limit, 'offset' => $offset]);
    }

    /**
     * Get a single template by ID.
     *
     * @param  string  $id  The template ID.
     * @param  bool|null  $draft  Whether to retrieve the draft version (null = published).
     * @return array<string, mixed>
     */
    public function getTemplate(string $id, ?bool $draft = null): array
    {
        $params = [];
        if ($draft !== null) {
            $params['draft'] = $draft ? 'true' : 'false';
        }

        return $this->request('GET', '/templates/' . urlencode($id), $params);
    }

    /**
     * Send a transmission (email).
     *
     * @param  array<string, mixed>  $payload  The transmission payload.
     * @return array<string, mixed>
     */
    public function sendTransmission(array $payload): array
    {
        return $this->request('POST', '/transmissions', $payload);
    }

    /**
     * List webhooks.
     *
     * @param  int  $limit  Maximum number of webhooks to return.
     * @param  int  $offset  Offset for pagination.
     * @return array<string, mixed>
     */
    public function listWebhooks(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/webhooks', ['limit' => $limit, 'offset' => $offset]);
    }

    /**
     * Get current account information.
     *
     * @return array<string, mixed>
     */
    public function getAccount(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the SparkPost API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('SparkPost API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("SparkPost API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("SparkPost API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('errors') ?? $response->json('error') ?? $body;
                Log::error("SparkPost API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("SparkPost API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("SparkPost API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to SparkPost API: {$e->getMessage()}");
        }
    }
}
