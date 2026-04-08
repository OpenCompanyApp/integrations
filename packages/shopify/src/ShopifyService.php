<?php

namespace OpenCompany\Integrations\Shopify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShopifyService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.shopify.com/v1',
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
     * List products.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, status, product_type, vendor, etc.)
     * @return array<string, mixed>
     */
    public function listProducts(array $params = []): array
    {
        return $this->request('GET', '/products', $params);
    }

    /**
     * Get a single product by ID.
     *
     * @return array<string, mixed>
     */
    public function getProduct(string $productId): array
    {
        return $this->request('GET', '/products/' . $productId);
    }

    /**
     * Create a new product.
     *
     * @param  array<string, mixed>  $data  Product data (title, body_html, vendor, product_type, status, tags, etc.)
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
     * @param  array<string, mixed>  $params  Query parameters (limit, status, financial_status, fulfillment_status, etc.)
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
    public function getOrder(string $orderId): array
    {
        return $this->request('GET', '/orders/' . $orderId);
    }

    // ─── Customers ─────────────────────────────────────────────────────────

    /**
     * List customers.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, page, etc.)
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    // ─── Current User ──────────────────────────────────────────────────────

    /**
     * Get the currently authenticated user / shop info.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/shop');
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

        return $response->json('data', $response->json() ?? []);
    }

    /**
     * Make a raw HTTP request to the Shopify API.
     *
     * @param  array<string, mixed>  $data
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Shopify integration is not configured. Access token is required.');
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
                $errorTitle = $errorBody['title'] ?? $response->body();
                $errors = $errorBody['errors'] ?? [];

                $errorMessage = is_string($errorTitle) ? $errorTitle : json_encode($errorTitle);
                if (!empty($errors)) {
                    $errorMessage .= ' — ' . json_encode($errors);
                }

                Log::error("Shopify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $errorMessage,
                ]);

                throw new \RuntimeException("Shopify API error ({$response->status()}): {$errorMessage}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Shopify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Shopify API: {$e->getMessage()}");
        }
    }
}
