<?php

namespace OpenCompany\Integrations\Copper;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CopperService
{
    public function __construct(
        private string $apiKey = '',
        private string $email = '',
        private string $baseUrl = 'https://api.copper.com/developer_api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->email);
    }

    /**
     * Search/list contacts.
     *
     * @param  array<string, mixed>  $params  Search parameters (page_size, sort_by, etc.)
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('POST', '/contacts/search', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(int $id): array
    {
        return $this->request('GET', '/contacts/' . $id);
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact data (name, email, etc.)
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', $data);
    }

    /**
     * Update an existing contact.
     *
     * @param  array<string, mixed>  $data  Fields to update
     * @return array<string, mixed>
     */
    public function updateContact(int $id, array $data): array
    {
        return $this->request('PUT', '/contacts/' . $id, $data);
    }

    /**
     * Delete a contact.
     */
    public function deleteContact(int $id): void
    {
        $this->request('DELETE', '/contacts/' . $id);
    }

    /**
     * Search/list companies.
     *
     * @param  array<string, mixed>  $params  Search parameters (page_size, sort_by, etc.)
     * @return array<string, mixed>
     */
    public function listCompanies(array $params = []): array
    {
        return $this->request('POST', '/companies/search', $params);
    }

    /**
     * Get a single company by ID.
     *
     * @return array<string, mixed>
     */
    public function getCompany(int $id): array
    {
        return $this->request('GET', '/companies/' . $id);
    }

    /**
     * Create a new company.
     *
     * @param  array<string, mixed>  $data  Company data (name, etc.)
     * @return array<string, mixed>
     */
    public function createCompany(array $data): array
    {
        return $this->request('POST', '/companies', $data);
    }

    /**
     * Search/list opportunities.
     *
     * @param  array<string, mixed>  $params  Search parameters (page_size, sort_by, etc.)
     * @return array<string, mixed>
     */
    public function listOpportunities(array $params = []): array
    {
        return $this->request('POST', '/opportunities/search', $params);
    }

    /**
     * Get a single opportunity by ID.
     *
     * @return array<string, mixed>
     */
    public function getOpportunity(int $id): array
    {
        return $this->request('GET', '/opportunities/' . $id);
    }

    /**
     * Create a new opportunity.
     *
     * @param  array<string, mixed>  $data  Opportunity data (name, pipeline_id, etc.)
     * @return array<string, mixed>
     */
    public function createOpportunity(array $data): array
    {
        return $this->request('POST', '/opportunities', $data);
    }

    /**
     * List all pipelines.
     *
     * @return array<string, mixed>
     */
    public function listPipelines(): array
    {
        return $this->request('GET', '/pipelines');
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        // DELETE endpoints may return empty body
        $body = $response->body();
        if (empty($body) || trim($body) === '') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Copper API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->email) {
            throw new \RuntimeException('Copper API key and email are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-PW-AccessToken' => $this->apiKey,
                'X-PW-Application' => 'developer_api',
                'X-PW-UserEmail' => $this->email,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();
                Log::error("Copper API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Copper API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Copper API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Copper API: {$e->getMessage()}");
        }
    }
}
