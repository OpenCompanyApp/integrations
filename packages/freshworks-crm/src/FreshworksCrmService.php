<?php

namespace OpenCompany\Integrations\FreshworksCrm;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Freshworks CRM/Freshsales REST API.
 *
 * Handles token authentication, request dispatch, response parsing, and
 * endpoint helpers used by Freshworks CRM tools.
 */
class FreshworksCrmService
{
    /**
     * @param  string  $apiKey  Freshworks CRM API token.
     * @param  string  $baseUrl  Base URL ending in /crm/sales.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '' && $this->baseUrl !== '';
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * List contacts with pagination.
     *
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $perPage = 20): array
    {
        return $this->apiGet('/api/contacts', ['page' => $page, 'per_page' => $perPage]);
    }

    /**
     * Get a single contact by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(int $id): array
    {
        return $this->apiGet('/api/contacts/' . $id);
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact data.
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->apiPost('/api/contacts', ['contact' => $data]);
    }

    /**
     * List deals with pagination and optional stage filter.
     *
     * @return array<string, mixed>
     */
    public function listDeals(int $page = 1, int $perPage = 20, ?int $stage = null): array
    {
        $params = ['page' => $page, 'per_page' => $perPage];

        if ($stage !== null) {
            $params['stage'] = $stage;
        }

        return $this->apiGet('/api/deals', $params);
    }

    /**
     * Get a single deal by ID.
     *
     * @return array<string, mixed>
     */
    public function getDeal(int $id): array
    {
        return $this->apiGet('/api/deals/' . $id);
    }

    /**
     * List sales accounts with pagination.
     *
     * @return array<string, mixed>
     */
    public function listAccounts(int $page = 1, int $perPage = 20): array
    {
        return $this->apiGet('/api/sales_accounts', ['page' => $page, 'per_page' => $perPage]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/api/users/me');
    }

    /**
     * Run a GET request against a Freshworks CRM path.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Run a POST request against a Freshworks CRM path.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $query, $body);
    }

    /**
     * Run a PUT request against a Freshworks CRM path.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, $query, $body);
    }

    /**
     * Run a DELETE request against a Freshworks CRM path.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204 || trim($response->body()) === '') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Freshworks CRM API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('Freshworks CRM API key is not configured.');
        }

        if (!$this->baseUrl) {
            throw new RuntimeException('Freshworks CRM domain is not configured.');
        }

        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Token token=' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $responseBody = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($responseBody), '<!DOCTYPE')) {
                    Log::warning("Freshworks CRM API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Freshworks CRM API endpoint not available (HTTP {$response->status()}). Check the domain and API key.");
                }

                $error = $response->json('error') ?? $response->json('errors') ?? $responseBody;
                Log::error("Freshworks CRM API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Freshworks CRM API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Freshworks CRM API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Freshworks CRM API: {$e->getMessage()}");
        }
    }

    /**
     * Build a Freshworks CRM API URL with query parameters.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query = []): string
    {
        $url = $this->baseUrl . '/' . ltrim($path, '/');
        $query = array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');

        if ($query === []) {
            return $url;
        }

        return $url . '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    }
}
