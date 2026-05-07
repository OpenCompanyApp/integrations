<?php

namespace OpenCompany\Integrations\BigCommerce;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for BigCommerce Admin REST APIs.
 *
 * Handles token authentication, store-scoped base URL construction, request
 * dispatch, error logging and response parsing for all BigCommerce tools.
 */
class BigCommerceService
{
    /**
     * @param  string  $accessToken  BigCommerce API access token.
     * @param  string  $storeHash  Store hash used in api.bigcommerce.com/stores/{store_hash}.
     * @param  string  $baseUrl  Optional full store API base URL for proxies or tests.
     */
    public function __construct(
        private string $accessToken = '',
        private string $storeHash = '',
        private string $baseUrl = '',
    ) {
        if ($this->baseUrl === '' && $this->storeHash !== '') {
            $this->baseUrl = 'https://api.bigcommerce.com/stores/' . $this->storeHash;
        }

        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->baseUrl = preg_replace('~/v[23]$~', '', $this->baseUrl) ?? $this->baseUrl;
    }

    /**
     * Check whether the service is properly configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->baseUrl);
    }

    // Products

    /**
     * List products from the catalog.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, page, include, etc.)
     * @return array<string, mixed>
     */
    public function listProducts(array $params = []): array
    {
        return $this->apiGet('/v3/catalog/products', $params);
    }

    /**
     * Get a single product by ID.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (include, etc.)
     * @return array<string, mixed>
     */
    public function getProduct(int $productId, array $params = []): array
    {
        return $this->apiGet('/v3/catalog/products/' . $productId, $params);
    }

    /**
     * Create a new product.
     *
     * @param  array<string, mixed>  $data  Product data (name, price, type, sku, etc.)
     * @return array<string, mixed>
     */
    public function createProduct(array $data): array
    {
        return $this->apiPost('/v3/catalog/products', $data);
    }

    // Orders

    /**
     * List orders.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, page, status_id, etc.)
     * @return array<string, mixed>
     */
    public function listOrders(array $params = []): array
    {
        return $this->apiGet('/v2/orders', $params);
    }

    /**
     * Get a single order by ID.
     *
     * @return array<string, mixed>
     */
    public function getOrder(int $orderId): array
    {
        return $this->apiGet('/v2/orders/' . $orderId);
    }

    // Customers

    /**
     * List customers.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, page, etc.)
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->apiGet('/v3/customers', $params);
    }

    // Current User

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/v3/storefront/status');
    }

    /**
     * Send a GET request to a BigCommerce endpoint.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Send a POST request to a BigCommerce endpoint.
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
     * Send a PUT request to a BigCommerce endpoint.
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
     * Send a DELETE request to a BigCommerce endpoint.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    // HTTP Layer

    /**
     * Make an API request and return parsed JSON data.
     *
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PUT)
     * @param  array<string, mixed>  $query  Query params for mutating requests
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the BigCommerce API.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('BigCommerce integration is not configured. Access token and store hash or base URL are required.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Auth-Token' => $this->accessToken,
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
                $errorBody = $response->json();
                $errorTitle = $errorBody['title'] ?? $response->body();
                $errors = $errorBody['errors'] ?? [];

                $errorMessage = is_string($errorTitle) ? $errorTitle : json_encode($errorTitle);
                if (!empty($errors)) {
                    $errorMessage .= ' - ' . json_encode($errors);
                }

                Log::error("BigCommerce API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $errorMessage,
                ]);

                throw new RuntimeException("BigCommerce API error ({$response->status()}): {$errorMessage}");
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("BigCommerce API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to BigCommerce API: {$e->getMessage()}");
        }
    }
}
