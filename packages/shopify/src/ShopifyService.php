<?php

namespace OpenCompany\Integrations\Shopify;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Shopify Admin REST APIs.
 *
 * Builds shop-scoped Admin API URLs, sends access-token authentication, and
 * centralizes request dispatch, error logging, and response parsing.
 */
class ShopifyService
{
    /**
     * @param  string  $accessToken  Shopify Admin API access token.
     * @param  string  $shopDomain  Store domain such as example.myshopify.com.
     * @param  string  $apiVersion  Shopify Admin API version such as 2025-10.
     * @param  string  $baseUrl  Optional full Admin REST base URL for proxies or tests.
     */
    public function __construct(
        private string $accessToken = '',
        private string $shopDomain = '',
        private string $apiVersion = '2025-10',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = $this->normalizeBaseUrl($this->shopDomain, $this->apiVersion, $this->baseUrl);
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '' && $this->baseUrl !== '';
    }

    /**
     * List products.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listProducts(array $params = []): array
    {
        return $this->apiGet('/products.json', $params);
    }

    /**
     * Get one product.
     *
     * @return array<string, mixed>
     */
    public function getProduct(string $productId): array
    {
        return $this->apiGet('/products/' . $productId . '.json');
    }

    /**
     * Create a product.
     *
     * @param  array<string, mixed>  $data  Product request body.
     * @return array<string, mixed>
     */
    public function createProduct(array $data): array
    {
        return $this->apiPost('/products.json', $data);
    }

    /**
     * List orders.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listOrders(array $params = []): array
    {
        return $this->apiGet('/orders.json', $params);
    }

    /**
     * Get one order.
     *
     * @return array<string, mixed>
     */
    public function getOrder(string $orderId): array
    {
        return $this->apiGet('/orders/' . $orderId . '.json');
    }

    /**
     * List customers.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->apiGet('/customers.json', $params);
    }

    /**
     * Get shop metadata.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/shop.json');
    }

    /**
     * Send a GET request.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Send a POST request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $data = [], array $query = []): array
    {
        return $this->request('POST', $path, $data, $query);
    }

    /**
     * Send a PUT request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PUT', $path, $data, $query);
    }

    /**
     * Send a DELETE request.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    /**
     * Make an API request and return parsed JSON data.
     *
     * @param  array<string, mixed>  $data  Query params (GET/DELETE) or body (POST/PUT).
     * @param  array<string, mixed>  $query  Query params for mutating requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to Shopify.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Shopify integration is not configured. Access token and shop domain or base URL are required.');
        }

        $url = $this->baseUrl . '/' . ltrim($path, '/');

        try {
            $http = Http::withHeaders([
                'X-Shopify-Access-Token' => $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->withOptions(['query' => $query])->post($url, $data),
                'PUT' => $http->withOptions(['query' => $query])->put($url, $data),
                'DELETE' => $http->withOptions(['query' => $data])->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $body = $response->json();
                $errors = $body['errors'] ?? $body['error'] ?? $body['message'] ?? $response->body();
                $errorMessage = is_string($errors) ? $errors : json_encode($errors);

                Log::error("Shopify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $errorMessage,
                ]);

                throw new RuntimeException("Shopify API error ({$response->status()}): {$errorMessage}");
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Shopify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Shopify API: {$e->getMessage()}");
        }
    }

    private function normalizeBaseUrl(string $shopDomain, string $apiVersion, string $baseUrl = ''): string
    {
        if ($baseUrl !== '') {
            $baseUrl = preg_replace('~/$~', '', $baseUrl) ?? $baseUrl;
            return preg_replace('~/+$~', '', $baseUrl) ?? $baseUrl;
        }

        if ($shopDomain === '') {
            return '';
        }

        $shopDomain = preg_replace('~^https?://~', '', $shopDomain) ?? $shopDomain;
        $shopDomain = rtrim($shopDomain, '/');

        return "https://{$shopDomain}/admin/api/{$apiVersion}";
    }
}