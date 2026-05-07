<?php

namespace OpenCompany\Integrations\Copper;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Copper Developer API.
 *
 * Handles Copper API-key headers, request dispatch, response parsing, and
 * endpoint-specific helpers used by Copper tools.
 */
class CopperService
{
    /**
     * @param  string  $apiKey  Copper API key.
     * @param  string  $email  Email address of the Copper API token owner.
     * @param  string  $baseUrl  Copper Developer API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $email = '',
        private string $baseUrl = 'https://api.copper.com/developer_api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '' && $this->email !== '';
    }

    /**
     * Search/list Copper people. Existing contact tools delegate here for compatibility.
     *
     * @param  array<string, mixed>  $params  Search parameters.
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->apiPost('/people/search', $params);
    }

    /**
     * Get a single Copper person by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(int $id): array
    {
        return $this->apiGet('/people/' . $id);
    }

    /**
     * Create a new Copper person.
     *
     * @param  array<string, mixed>  $data  Person data.
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->apiPost('/people', $data);
    }

    /**
     * Update an existing Copper person.
     *
     * @param  array<string, mixed>  $data  Fields to update.
     * @return array<string, mixed>
     */
    public function updateContact(int $id, array $data): array
    {
        return $this->apiPut('/people/' . $id, $data);
    }

    /**
     * Delete a Copper person.
     */
    public function deleteContact(int $id): void
    {
        $this->apiDelete('/people/' . $id);
    }

    /**
     * Search/list companies.
     *
     * @param  array<string, mixed>  $params  Search parameters.
     * @return array<string, mixed>
     */
    public function listCompanies(array $params = []): array
    {
        return $this->apiPost('/companies/search', $params);
    }

    /**
     * Get a single company by ID.
     *
     * @return array<string, mixed>
     */
    public function getCompany(int $id): array
    {
        return $this->apiGet('/companies/' . $id);
    }

    /**
     * Create a new company.
     *
     * @param  array<string, mixed>  $data  Company data.
     * @return array<string, mixed>
     */
    public function createCompany(array $data): array
    {
        return $this->apiPost('/companies', $data);
    }

    /**
     * Search/list opportunities.
     *
     * @param  array<string, mixed>  $params  Search parameters.
     * @return array<string, mixed>
     */
    public function listOpportunities(array $params = []): array
    {
        return $this->apiPost('/opportunities/search', $params);
    }

    /**
     * Get a single opportunity by ID.
     *
     * @return array<string, mixed>
     */
    public function getOpportunity(int $id): array
    {
        return $this->apiGet('/opportunities/' . $id);
    }

    /**
     * Create a new opportunity.
     *
     * @param  array<string, mixed>  $data  Opportunity data.
     * @return array<string, mixed>
     */
    public function createOpportunity(array $data): array
    {
        return $this->apiPost('/opportunities', $data);
    }

    /**
     * List all pipelines.
     *
     * @return array<string, mixed>
     */
    public function listPipelines(): array
    {
        return $this->apiGet('/pipelines');
    }

    /**
     * Get the current authenticated API user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/users/me');
    }

    /**
     * Run a GET request against a Copper API path.
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
     * Run a POST request against a Copper API path.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $query, $body);
    }

    /**
     * Run a PUT request against a Copper API path.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, $query, $body);
    }

    /**
     * Run a DELETE request against a Copper API path.
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
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
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
     * Make a raw HTTP request to the Copper API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->apiKey || !$this->email) {
            throw new RuntimeException('Copper API key and email are not configured.');
        }

        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'X-PW-AccessToken' => $this->apiKey,
                'X-PW-Application' => 'developer_api',
                'X-PW-UserEmail' => $this->email,
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
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("Copper API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Copper API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Copper API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Copper API: {$e->getMessage()}");
        }
    }

    /**
     * Build a Copper request URL with query parameters.
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
