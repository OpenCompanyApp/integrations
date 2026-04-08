<?php

namespace OpenCompany\Integrations\FreshworksCrm;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FreshworksCrmService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->baseUrl);
    }

    /**
     * Get the configured base URL.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * List contacts with pagination.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Number of results per page.
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $perPage = 20): array
    {
        return $this->request('GET', '/api/contacts', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  int  $id  The contact ID.
     * @return array<string, mixed>
     */
    public function getContact(int $id): array
    {
        return $this->request('GET', '/api/contacts/' . $id);
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact data (first_name, last_name, email, mobile_number).
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/api/contacts', $data);
    }

    /**
     * List deals with pagination and optional stage filter.
     *
     * @param  int       $page     Page number (1-based).
     * @param  int       $perPage  Number of results per page.
     * @param  int|null  $stage    Optional deal stage ID to filter by.
     * @return array<string, mixed>
     */
    public function listDeals(int $page = 1, int $perPage = 20, ?int $stage = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($stage !== null) {
            $params['stage'] = $stage;
        }

        return $this->request('GET', '/api/deals', $params);
    }

    /**
     * Get a single deal by ID.
     *
     * @param  int  $id  The deal ID.
     * @return array<string, mixed>
     */
    public function getDeal(int $id): array
    {
        return $this->request('GET', '/api/deals/' . $id);
    }

    /**
     * List sales accounts with pagination.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Number of results per page.
     * @return array<string, mixed>
     */
    public function listAccounts(int $page = 1, int $perPage = 20): array
    {
        return $this->request('GET', '/api/sales_accounts', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string               $method  HTTP method.
     * @param  string               $path    API path.
     * @param  array<string, mixed> $data    Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Freshworks CRM API.
     *
     * @param  string               $method  HTTP method.
     * @param  string               $path    API path.
     * @param  array<string, mixed> $data    Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Freshworks CRM API key is not configured.');
        }

        if (!$this->baseUrl) {
            throw new \RuntimeException('Freshworks CRM domain is not configured.');
        }

        $url = $this->baseUrl . $path;

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
                    Log::warning("Freshworks CRM API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Freshworks CRM API endpoint not available (HTTP {$response->status()}). Check the domain and API key.");
                }

                $error = $response->json('error') ?? $response->json('errors') ?? $body;
                Log::error("Freshworks CRM API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Freshworks CRM API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Freshworks CRM API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Freshworks CRM API: {$e->getMessage()}");
        }
    }
}
