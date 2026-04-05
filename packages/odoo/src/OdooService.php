<?php

namespace OpenCompany\Integrations\Odoo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Odoo ERP API service — handles authentication, request execution, and error handling.
 *
 * Communicates with the Odoo JSON-RPC/Web API using Bearer token authentication.
 * Supports configurable base URL and database name for multi-instance deployments.
 */
class OdooService
{
    /**
     * Create a new OdooService instance.
     *
     * @param string $apiKey  The API key for authenticating with the Odoo instance.
     * @param string $baseUrl The base URL of the Odoo instance (e.g., "https://your-odoo-instance.com").
     * @param string $database The database name for the Odoo instance.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://your-odoo-instance.com',
        private string $database = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the configured database name.
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * List contacts (res.partner) with optional pagination and filtering.
     *
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @param  array<string, mixed>  $filters  Optional domain filters.
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $limit = 20, array $filters = []): array
    {
        return $this->request('GET', '/api/contacts', array_merge([
            'page' => $page,
            'limit' => $limit,
        ], $filters));
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
     * Create a new contact (res.partner).
     *
     * @param  array<string, mixed>  $data  The contact data (name, email, phone, etc.).
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/api/contacts', $data);
    }

    /**
     * List sales orders with optional pagination and filtering.
     *
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @param  array<string, mixed>  $filters  Optional domain filters.
     * @return array<string, mixed>
     */
    public function listSalesOrders(int $page = 1, int $limit = 20, array $filters = []): array
    {
        return $this->request('GET', '/api/sale.orders', array_merge([
            'page' => $page,
            'limit' => $limit,
        ], $filters));
    }

    /**
     * List invoices with optional pagination and filtering.
     *
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @param  array<string, mixed>  $filters  Optional domain filters.
     * @return array<string, mixed>
     */
    public function listInvoices(int $page = 1, int $limit = 20, array $filters = []): array
    {
        return $this->request('GET', '/api/invoices', array_merge([
            'page' => $page,
            'limit' => $limit,
        ], $filters));
    }

    /**
     * List products with optional pagination and filtering.
     *
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @param  array<string, mixed>  $filters  Optional domain filters.
     * @return array<string, mixed>
     */
    public function listProducts(int $page = 1, int $limit = 20, array $filters = []): array
    {
        return $this->request('GET', '/api/products', array_merge([
            'page' => $page,
            'limit' => $limit,
        ], $filters));
    }

    /**
     * List leads/opportunities with optional pagination and filtering.
     *
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @param  array<string, mixed>  $filters  Optional domain filters.
     * @return array<string, mixed>
     */
    public function listLeads(int $page = 1, int $limit = 20, array $filters = []): array
    {
        return $this->request('GET', '/api/leads', array_merge([
            'page' => $page,
            'limit' => $limit,
        ], $filters));
    }

    /**
     * Get the currently authenticated user's information.
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
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Odoo API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Odoo API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            if ($this->database) {
                $http->withHeaders(['X-Database' => $this->database]);
            }

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
                    Log::warning("Odoo API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Odoo API endpoint not available (HTTP {$response->status()}). Check your Odoo instance URL and API configuration.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Odoo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Odoo API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Odoo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Odoo API: {$e->getMessage()}");
        }
    }
}
