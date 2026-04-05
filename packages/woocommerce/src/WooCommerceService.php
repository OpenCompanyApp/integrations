<?php

namespace OpenCompany\Integrations\WooCommerce;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * WooCommerce REST API service.
 *
 * Handles authentication via HTTP Basic Auth (consumer_key / consumer_secret)
 * and provides methods for all supported WooCommerce endpoints.
 */
class WooCommerceService
{
    /**
     * Create a new WooCommerce service instance.
     *
     * @param  string  $consumerKey   WooCommerce REST API consumer key.
     * @param  string  $consumerSecret WooCommerce REST API consumer secret.
     * @param  string  $baseUrl       Store base URL (e.g. https://example.com).
     */
    public function __construct(
        private string $consumerKey = '',
        private string $consumerSecret = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has enough configuration to make requests.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->consumerKey)
            && ! empty($this->consumerSecret)
            && ! empty($this->baseUrl);
    }

    // ── Products ────────────────────────────────────────────────────────

    /**
     * List products.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, status, search, etc.).
     * @return array<string, mixed>
     */
    public function listProducts(array $params = []): array
    {
        return $this->request('GET', '/products', $params);
    }

    /**
     * Get a single product by ID.
     *
     * @param  int  $id  Product ID.
     * @return array<string, mixed>
     */
    public function getProduct(int $id): array
    {
        return $this->request('GET', '/products/' . $id);
    }

    /**
     * Create a new product.
     *
     * @param  array<string, mixed>  $data  Product data (name, type, regular_price, etc.).
     * @return array<string, mixed>
     */
    public function createProduct(array $data): array
    {
        return $this->request('POST', '/products', $data);
    }

    /**
     * Update an existing product.
     *
     * @param  int  $id  Product ID.
     * @param  array<string, mixed>  $data  Fields to update.
     * @return array<string, mixed>
     */
    public function updateProduct(int $id, array $data): array
    {
        return $this->request('PUT', '/products/' . $id, $data);
    }

    /**
     * Delete a product.
     *
     * @param  int  $id  Product ID.
     * @return array<string, mixed>
     */
    public function deleteProduct(int $id): array
    {
        return $this->request('DELETE', '/products/' . $id);
    }

    // ── Orders ──────────────────────────────────────────────────────────

    /**
     * List orders.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, status, customer, etc.).
     * @return array<string, mixed>
     */
    public function listOrders(array $params = []): array
    {
        return $this->request('GET', '/orders', $params);
    }

    /**
     * Get a single order by ID.
     *
     * @param  int  $id  Order ID.
     * @return array<string, mixed>
     */
    public function getOrder(int $id): array
    {
        return $this->request('GET', '/orders/' . $id);
    }

    /**
     * Update an existing order.
     *
     * @param  int  $id  Order ID.
     * @param  array<string, mixed>  $data  Fields to update.
     * @return array<string, mixed>
     */
    public function updateOrder(int $id, array $data): array
    {
        return $this->request('PUT', '/orders/' . $id, $data);
    }

    // ── Customers ───────────────────────────────────────────────────────

    /**
     * List customers.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, search, role, etc.).
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    /**
     * Get a single customer by ID.
     *
     * @param  int  $id  Customer ID.
     * @return array<string, mixed>
     */
    public function getCustomer(int $id): array
    {
        return $this->request('GET', '/customers/' . $id);
    }

    /**
     * Create a new customer.
     *
     * @param  array<string, mixed>  $data  Customer data (email, first_name, last_name, etc.).
     * @return array<string, mixed>
     */
    public function createCustomer(array $data): array
    {
        return $this->request('POST', '/customers', $data);
    }

    // ── System Status ───────────────────────────────────────────────────

    /**
     * Get system status (used to verify credentials / "get current user").
     *
     * @return array<string, mixed>
     */
    public function getSystemStatus(): array
    {
        return $this->request('GET', '/system_status');
    }

    // ── Internal helpers ────────────────────────────────────────────────

    /**
     * Build the full API URL for a given path.
     */
    private function apiUrl(string $path): string
    {
        return $this->baseUrl . '/wp-json/wc/v3' . $path;
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * For GET requests, `$data` is sent as query parameters.
     * For POST/PUT/DELETE requests, `$data` is sent as JSON body.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. "/products").
     * @param  array<string, mixed>  $data  Request payload or query params.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the WooCommerce REST API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Payload or query parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('WooCommerce integration is not configured. Provide store URL, consumer key, and consumer secret.');
        }

        $url = $this->apiUrl($path);

        try {
            $http = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
                ->timeout(30)
                ->withHeaders(['Content-Type' => 'application/json']);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->body();
                $json = $response->json();

                $error = is_array($json)
                    ? ($json['message'] ?? json_encode($json))
                    : $body;

                Log::error("WooCommerce API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);

                throw new \RuntimeException(
                    "WooCommerce API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("WooCommerce API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to WooCommerce API: {$e->getMessage()}");
        }
    }
}
