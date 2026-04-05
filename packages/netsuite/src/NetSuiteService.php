<?php

namespace OpenCompany\Integrations\NetSuite;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NetSuiteService
{
    /**
     * Create a new NetSuiteService instance.
     *
     * @param  string  $accessToken  The OAuth 2.0 bearer token for NetSuite SuiteTalk REST API.
     * @param  string  $baseUrl  The base URL for the NetSuite REST API (e.g., https://{account_id}.suitetalk.api.netsuite.com/services/rest/record/v1).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with valid credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->baseUrl);
    }

    /**
     * List customers from NetSuite.
     *
     * @param  int  $limit  Maximum number of records to return.
     * @param  int  $offset  Zero-based offset for pagination.
     * @return array<string, mixed>
     */
    public function listCustomers(int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/customers', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single customer by internal ID.
     *
     * @param  string  $id  The internal ID of the customer.
     * @return array<string, mixed>
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', '/customers/' . urlencode($id));
    }

    /**
     * Create a new customer in NetSuite.
     *
     * @param  array<string, mixed>  $data  The customer data to create.
     * @return array<string, mixed>
     */
    public function createCustomer(array $data): array
    {
        return $this->request('POST', '/customers', $data);
    }

    /**
     * List invoices from NetSuite.
     *
     * @param  int  $limit  Maximum number of records to return.
     * @param  int  $offset  Zero-based offset for pagination.
     * @return array<string, mixed>
     */
    public function listInvoices(int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/invoices', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * List sales orders from NetSuite.
     *
     * @param  int  $limit  Maximum number of records to return.
     * @param  int  $offset  Zero-based offset for pagination.
     * @return array<string, mixed>
     */
    public function listSalesOrders(int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/salesOrders', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * List items from NetSuite.
     *
     * @param  int  $limit  Maximum number of records to return.
     * @param  int  $offset  Zero-based offset for pagination.
     * @return array<string, mixed>
     */
    public function listItems(int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/items', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get the current authenticated user's information.
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
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the NetSuite SuiteTalk REST API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If credentials are missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken || !$this->baseUrl) {
            throw new \RuntimeException('NetSuite access token or base URL is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Prefer' => 'transient',
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
                    Log::warning("NetSuite API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("NetSuite API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("NetSuite API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("NetSuite API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("NetSuite API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to NetSuite API: {$e->getMessage()}");
        }
    }
}
