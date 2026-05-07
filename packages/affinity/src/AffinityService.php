<?php

namespace OpenCompany\Integrations\Affinity;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Affinity API.
 *
 * Uses the current v2 bearer-token API by default while allowing explicit
 * relative paths for compatibility with documented legacy v1 endpoints.
 */
class AffinityService
{
    /**
     * @param  string  $apiKey  Affinity API key used as a bearer token.
     * @param  string  $baseUrl  Base URL for Affinity API requests.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.affinity.co',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Get the authenticated Affinity API user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/auth/user');
    }

    /**
     * List people in Affinity.
     *
     * @param  array<string, mixed>  $params  Query parameters such as cursor, limit, fieldIds, or fieldTypes.
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->apiGet('/persons', $params);
    }

    /**
     * Get a person by ID.
     *
     * @param  int|string  $id  Affinity person ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function getContact(int|string $id, array $params = []): array
    {
        return $this->apiGet('/persons/' . rawurlencode((string) $id), $params);
    }

    /**
     * Create a person through the documented legacy endpoint.
     *
     * @param  array<string, mixed>  $data  Person payload.
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->apiPost('/persons', $data);
    }

    /**
     * List companies in Affinity.
     *
     * @param  array<string, mixed>  $params  Query parameters such as cursor, limit, fieldIds, or fieldTypes.
     * @return array<string, mixed>
     */
    public function listOrganizations(array $params = []): array
    {
        return $this->apiGet('/companies', $params);
    }

    /**
     * Get a company by ID.
     *
     * @param  int|string  $id  Affinity company ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function getOrganization(int|string $id, array $params = []): array
    {
        return $this->apiGet('/companies/' . rawurlencode((string) $id), $params);
    }

    /**
     * Create a company through the documented legacy endpoint.
     *
     * @param  array<string, mixed>  $data  Company payload.
     * @return array<string, mixed>
     */
    public function createOrganization(array $data): array
    {
        return $this->apiPost('/organizations', $data);
    }

    /**
     * List Affinity lists visible to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listLists(array $params = []): array
    {
        return $this->apiGet('/lists', $params);
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
     * @param  array<string, mixed>  $body  JSON request body.
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
     * @param  array<string, mixed>  $body  JSON request body.
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
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = [], array $query = []): array
    {
        return $this->request('DELETE', $path, $query, $body);
    }

    /**
     * Execute a request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
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
     * @param  array<string, mixed>  $body  JSON request body.
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Affinity API key is not configured.');
        }

        $url = $this->url($this->safePath($path), $query);

        try {
            $http = Http::withToken($this->apiKey)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->timeout(30);

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
            Log::error("Affinity API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Affinity API: {$e->getMessage()}");
        }
    }

    /**
     * Validate and normalize a relative API path.
     */
    private function safePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || preg_match('#^[a-z][a-z0-9+.-]*://#i', $path) || str_starts_with($path, '//') || str_contains($path, '..')) {
            throw new \InvalidArgumentException('Path must be a safe relative Affinity API path.');
        }

        $path = '/' . ltrim($path, '/');

        if (!str_starts_with($path, '/v1/') && !str_starts_with($path, '/v2/')) {
            $path = '/v2' . $path;
        }

        return $path;
    }

    /**
     * Build the absolute request URL.
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
            Log::warning("Affinity API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new \RuntimeException("Affinity API returned unexpected HTML (HTTP {$response->status()}).");
        }

        $error = $response->json('message') ?? $response->json('error') ?? $body;

        Log::error("Affinity API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new \RuntimeException("Affinity API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
