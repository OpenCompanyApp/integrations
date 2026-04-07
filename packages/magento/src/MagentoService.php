<?php

namespace OpenCompany\Integrations\Magento;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Magento API HTTP client.
 *
 * Handles authentication via Bearer token and provides methods for
 * interacting with the Magento REST API.
 *
 * @see https://developer.adobe.com/commerce/webapi/rest/
 */
class MagentoService
{
    /**
     * Create a new MagentoService instance.
     *
     * @param  string  $accessToken  The Magento API bearer token.
     * @param  string  $baseUrl      Base URL for the Magento REST API.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.magento.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    /**
     * Get the configured base URL.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * List products from the Magento catalog.
     *
     * @param  array  $params  Query parameters (searchCriteria, pageSize, etc.).
     * @return array<string, mixed>
     */
    public function listProducts(array $params = []): array
    {
        return $this->request('GET', '/products', $params);
    }

    /**
     * Get a single product by its SKU.
     *
     * @param  string  $sku  The product SKU.
     * @return array<string, mixed>
     */
    public function getProduct(string $sku): array
    {
        return $this->request('GET', '/products/' . urlencode($sku));
    }

    /**
     * Create a new product in the Magento catalog.
     *
     * @param  array  $data  Product data (sku, name, price, attribute_set_id, etc.).
     * @return array<string, mixed>
     */
    public function createProduct(array $data): array
    {
        return $this->request('POST', '/products', ['product' => $data]);
    }

    /**
     * List orders from the Magento store.
     *
     * @param  array  $params  Query parameters (searchCriteria, pageSize, etc.).
     * @return array<string, mixed>
     */
    public function listOrders(array $params = []): array
    {
        return $this->request('GET', '/orders', $params);
    }

    /**
     * Get a single order by its ID.
     *
     * @param  string  $orderId  The order increment ID or entity ID.
     * @return array<string, mixed>
     */
    public function getOrder(string $orderId): array
    {
        return $this->request('GET', '/orders/' . urlencode($orderId));
    }

    /**
     * List customers from the Magento store.
     *
     * @param  array  $params  Query parameters (searchCriteria, pageSize, etc.).
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    /**
     * Get current user / admin information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Magento API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Request body or query parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Magento access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withToken($this->accessToken)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->body();

                Log::error("Magento API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Magento API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Magento API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Magento API: {$e->getMessage()}");
        }
    }
}
