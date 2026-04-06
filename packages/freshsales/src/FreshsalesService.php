<?php

namespace OpenCompany\Integrations\Freshsales;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FreshsalesService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key and base URL.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->baseUrl);
    }

    /**
     * List contacts with optional pagination and sorting.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page.
     * @param  string|null  $sort     Sort direction: "asc" or "desc".
     * @param  string|null  $sortBy   Field to sort by (e.g., "created_at", "updated_at").
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $perPage = 20, ?string $sort = null, ?string $sortBy = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($sort !== null) {
            $params['sort'] = $sort;
        }
        if ($sortBy !== null) {
            $params['sort_by'] = $sortBy;
        }

        return $this->request('GET', '/api/contacts', $params);
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
     * @param  array<string, mixed>  $data  Contact data (first_name, last_name, email, mobile_number, etc.).
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/api/contacts', ['contact' => $data]);
    }

    /**
     * List deals with optional pagination.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page.
     * @return array<string, mixed>
     */
    public function listDeals(int $page = 1, int $perPage = 20): array
    {
        return $this->request('GET', '/api/deals', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
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
     * List sales accounts with optional pagination.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page.
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
     * Get a single sales account by ID.
     *
     * @param  int  $id  The account ID.
     * @return array<string, mixed>
     */
    public function getAccount(int $id): array
    {
        return $this->request('GET', '/api/sales_accounts/' . $id);
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
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g., "/api/contacts").
     * @param  array<string, mixed>  $data  Query parameters or request body.
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
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->baseUrl) {
            throw new \RuntimeException('Freshsales API key and domain are not configured.');
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
                    Log::warning("Freshsales API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Freshsales API endpoint not available (HTTP {$response->status()}). Check your domain and API key.");
                }

                $error = $response->json('error') ?? $response->json('errors') ?? $body;
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
