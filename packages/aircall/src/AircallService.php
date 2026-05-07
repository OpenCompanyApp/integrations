<?php

namespace OpenCompany\Integrations\Aircall;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Aircall Public API.
 *
 * Handles bearer-token authentication, v1/v2 path normalization, response
 * parsing, and safe relative endpoint access for Aircall tools.
 */
class AircallService
{
    /**
     * @param  string  $accessToken  Aircall OAuth access token or manual API token.
     * @param  string  $baseUrl  Root Aircall API URL.
     * @param  string  $apiId  Aircall Basic Auth API ID.
     * @param  string  $apiToken  Aircall Basic Auth API token.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.aircall.io',
        private string $apiId = '',
        private string $apiToken = '',
    ) {
        $this->baseUrl = preg_replace('#/v[12]$#', '', rtrim($this->baseUrl, '/')) ?: 'https://api.aircall.io';
    }

    /**
     * Check whether the Aircall integration is configured.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '' || ($this->apiId !== '' && $this->apiToken !== '');
    }

    /**
     * List calls with optional filters and pagination.
     *
     * @param  array<string, mixed>  $filters  Query parameters.
     * @return array<string, mixed>
     */
    public function listCalls(array $filters = []): array
    {
        return $this->apiGet('/calls', $filters);
    }

    /**
     * Retrieve a single call by ID.
     *
     * @return array<string, mixed>
     */
    public function getCall(int|string $callId): array
    {
        return $this->apiGet('/calls/' . rawurlencode((string) $callId));
    }

    /**
     * List contacts with optional filters and pagination.
     *
     * @param  array<string, mixed>  $filters  Query parameters.
     * @return array<string, mixed>
     */
    public function listContacts(array $filters = []): array
    {
        return $this->apiGet('/contacts', $filters);
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact payload.
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->apiPost('/contacts', $data);
    }

    /**
     * Update an existing contact.
     *
     * @param  array<string, mixed>  $data  Contact payload.
     * @return array<string, mixed>
     */
    public function updateContact(int|string $contactId, array $data): array
    {
        return $this->apiPut('/contacts/' . rawurlencode((string) $contactId), $data);
    }

    /**
     * List users with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->apiGet('/users', $params);
    }

    /**
     * Get the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/users/me');
    }

    /**
     * List phone numbers.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listNumbers(array $params = []): array
    {
        return $this->apiGet('/numbers', $params);
    }

    /**
     * Execute a safe relative GET request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Execute a safe relative POST request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $query, $body);
    }

    /**
     * Execute a safe relative PUT request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, $query, $body);
    }

    /**
     * Execute a safe relative DELETE request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = [], array $query = []): array
    {
        return $this->request('DELETE', $path, $query, $body);
    }

    /**
     * Execute a request and parse JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if (trim($response->body()) === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? [];
    }

    /**
     * Execute an authenticated raw HTTP request.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Aircall API credentials are not configured.');
        }

        $url = $this->url($this->safePath($path), $query);

        try {
            $http = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $http = $this->apiId !== '' && $this->apiToken !== ''
                ? $http->withBasicAuth($this->apiId, $this->apiToken)
                : $http->withToken($this->accessToken);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Aircall API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Aircall API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize a safe relative Aircall path.
     */
    private function safePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || preg_match('#^[a-z][a-z0-9+.-]*://#i', $path) || str_starts_with($path, '//') || str_contains($path, '..')) {
            throw new \InvalidArgumentException('Path must be a safe relative Aircall API path.');
        }

        $path = '/' . ltrim($path, '/');

        if (!str_starts_with($path, '/v1/') && !str_starts_with($path, '/v2/')) {
            $path = '/v1' . $path;
        }

        return $path;
    }

    /**
     * Build an absolute API URL.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function url(string $path, array $query = []): string
    {
        $query = array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');

        if ($query === []) {
            return $this->baseUrl . $path;
        }

        return $this->baseUrl . $path . '?' . http_build_query($query);
    }

    /**
     * Parse and throw a normalized API error.
     *
     * @throws \RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type') ?? '';
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Aircall API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new \RuntimeException("Aircall API returned unexpected HTML (HTTP {$response->status()}).");
        }

        $error = $response->json('error') ?? $response->json('message') ?? $body;

        Log::error("Aircall API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new \RuntimeException("Aircall API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
