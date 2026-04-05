<?php

namespace OpenCompany\Integrations\Freshsales;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FreshsalesService
{
    /**
     * Create a new FreshsalesService instance.
     *
     * @param  string  $apiKey  The Freshsales API token.
     * @param  string  $domain  The Freshsales account domain (e.g., "mycompany").
     */
    public function __construct(
        private string $apiKey = '',
        private string $domain = '',
    ) {}

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->domain);
    }

    /**
     * Get the base URL for the Freshsales API.
     */
    public function getBaseUrl(): string
    {
        return "https://{$this->domain}.myfreshworks.com/crm/sales/api";
    }

    /**
     * List contacts with optional filters.
     *
     * @param  array  $filters  Query parameters (e.g., page, per_page, sort, sort_type).
     * @return array<string, mixed>
     */
    public function listContacts(array $filters = []): array
    {
        return $this->request('GET', '/contacts', $filters);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  int  $id  The contact ID.
     * @return array<string, mixed>
     */
    public function getContact(int $id): array
    {
        return $this->request('GET', '/contacts/' . $id);
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact data (first_name, last_name, email, etc.).
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', ['contact' => $data]);
    }

    /**
     * Update an existing contact.
     *
     * @param  int  $id  The contact ID.
     * @param  array<string, mixed>  $data  Fields to update.
     * @return array<string, mixed>
     */
    public function updateContact(int $id, array $data): array
    {
        return $this->request('PUT', '/contacts/' . $id, ['contact' => $data]);
    }

    /**
     * Delete a contact by ID.
     *
     * @param  int  $id  The contact ID.
     */
    public function deleteContact(int $id): void
    {
        $this->request('DELETE', '/contacts/' . $id);
    }

    /**
     * List deals with optional filters.
     *
     * @param  array  $filters  Query parameters (e.g., page, per_page, sort, sort_type).
     * @return array<string, mixed>
     */
    public function listDeals(array $filters = []): array
    {
        return $this->request('GET', '/deals', $filters);
    }

    /**
     * Get a single deal by ID.
     *
     * @param  int  $id  The deal ID.
     * @return array<string, mixed>
     */
    public function getDeal(int $id): array
    {
        return $this->request('GET', '/deals/' . $id);
    }

    /**
     * Create a new deal.
     *
     * @param  array<string, mixed>  $data  Deal data (name, amount, deal_stage_id, etc.).
     * @return array<string, mixed>
     */
    public function createDeal(array $data): array
    {
        return $this->request('POST', '/deals', ['deal' => $data]);
    }

    /**
     * List sales accounts with optional filters.
     *
     * @param  array  $filters  Query parameters (e.g., page, per_page, sort, sort_type).
     * @return array<string, mixed>
     */
    public function listAccounts(array $filters = []): array
    {
        return $this->request('GET', '/sales_accounts', $filters);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., "/contacts").
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Freshsales API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->domain) {
            throw new \RuntimeException('Freshsales API key and domain are not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Token token=' . $this->apiKey,
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Freshsales API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Freshsales API endpoint not available (HTTP {$response->status()}). Check your domain and API key.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Freshsales API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Freshsales API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Freshsales API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Freshsales API: {$e->getMessage()}");
        }
    }
}
