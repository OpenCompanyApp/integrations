<?php

namespace OpenCompany\Integrations\ZendeskSell;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZendeskSellService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.getbase.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List contacts with pagination and sorting.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Items per page (max 100).
     * @param  string|null  $sortBy   Sort field (e.g. "created_at", "updated_at", "last_name").
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $perPage = 25, ?string $sortBy = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => min($perPage, 100),
        ];

        if ($sortBy !== null) {
            $params['sort_by'] = $sortBy;
        }

        return $this->request('GET', '/v2/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  int  $id  The contact ID.
     * @return array<string, mixed>
     */
    public function getContact(int $id): array
    {
        return $this->request('GET', '/v2/contacts/' . $id);
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact data (first_name, last_name, email, organization_id, etc.).
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/v2/contacts', $data);
    }

    /**
     * List deals with pagination and optional status filter.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Items per page (max 100).
     * @param  string|null  $status   Filter by deal status (e.g. "open", "won", "lost", "abandoned").
     * @return array<string, mixed>
     */
    public function listDeals(int $page = 1, int $perPage = 25, ?string $status = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => min($perPage, 100),
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/v2/deals', $params);
    }

    /**
     * Get a single deal by ID.
     *
     * @param  int  $id  The deal ID.
     * @return array<string, mixed>
     */
    public function getDeal(int $id): array
    {
        return $this->request('GET', '/v2/deals/' . $id);
    }

    /**
     * List leads with pagination.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Items per page (max 100).
     * @return array<string, mixed>
     */
    public function listLeads(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/v2/leads', [
            'page' => $page,
            'per_page' => min($perPage, 100),
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. "/v2/contacts").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Zendesk Sell API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Zendesk Sell access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
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
                    Log::warning("Zendesk Sell API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Zendesk Sell API endpoint not available (HTTP {$response->status()}). Check the base URL.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Zendesk Sell API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Zendesk Sell API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zendesk Sell API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zendesk Sell API: {$e->getMessage()}");
        }
    }
}
