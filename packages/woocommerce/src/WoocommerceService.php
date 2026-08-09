<?php

namespace OpenCompany\Integrations\Woocommerce;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WoocommerceService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.woocommerce.com/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    // ─── Products ──────────────────────────────────────────────────────────

    /**
     * List products from the catalog.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, page, search, status, etc.)
     * @return array<string, mixed>
     */
    public function listProducts(array $params = []): array
    {
        return $this->request('GET', '/products', $params);
    }

    /**
     * Get a single product by ID.
     *
     * @param  array<string, mixed>  $params  Optional query parameters
     * @return array<string, mixed>
     */
    public function getProduct(int $productId, array $params = []): array
    {
        return $this->request('GET', '/products/' . $productId, $params);
    }

    /**
     * Create a new product.
     *
     * @param  array<string, mixed>  $data  Product data (name, regular_price, type, sku, etc.)
     * @return array<string, mixed>
     */
    public function createProduct(array $data): array
    {
        return $this->request('POST', '/products', $data);
    }

    // ─── Orders ────────────────────────────────────────────────────────────

    /**
     * List orders.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, page, status, etc.)
     * @return array<string, mixed>
     */
    public function listOrders(array $params = []): array
    {
        return $this->request('GET', '/orders', $params);
    }

    /**
     * Get a single order by ID.
     *
     * @return array<string, mixed>
     */
    public function getOrder(int $orderId): array
    {
        return $this->request('GET', '/orders/' . $orderId);
    }

    // ─── Customers ─────────────────────────────────────────────────────────

    /**
     * List customers.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, page, search, etc.)
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    // ─── Current User ──────────────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/system_status');
    }

    // ─── HTTP Layer ────────────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON data.
     *
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PUT)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the WooCommerce API.
     *
     * @param  array<string, mixed>  $data
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('WooCommerce integration is not configured. Access token is required.');
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
                $errorBody = $response->json();
                $errorMessage = $errorBody['message'] ?? $response->body();
                $errorCode = $errorBody['code'] ?? '';

                if (is_array($errorMessage)) {
                    $errorMessage = json_encode($errorMessage);
                }

                if (!empty($errorCode)) {
                    $errorMessage = "{$errorCode}: {$errorMessage}";
                }

                Log::error("WooCommerce API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $errorMessage,
                ]);

                throw new \RuntimeException("WooCommerce API error ({$response->status()}): {$errorMessage}");
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
