<?php

namespace OpenCompany\Integrations\Sellfy;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SellfyService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.sellfy.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List products.
     *
     * @param  int  $pageSize  Number of items per page.
     * @param  int  $page  Page number for pagination.
     * @return array<string, mixed>
     */
    public function listProducts(int $pageSize = 10, int $page = 1): array
    {
        return $this->request('GET', '/products', [
            'limit' => $pageSize,
            'page' => $page,
        ]);
    }

    /**
     * Get a single product by ID.
     *
     * @param  int|string  $id  The product ID.
     * @return array<string, mixed>
     */
    public function getProduct(int|string $id): array
    {
        return $this->request('GET', '/products/' . urlencode((string) $id));
    }

    /**
     * Create a new product.
     *
     * @param  array<string, mixed>  $data  Product data.
     * @return array<string, mixed>
     */
    public function createProduct(array $data): array
    {
        return $this->request('POST', '/products', $data);
    }

    /**
     * List orders.
     *
     * @param  int  $pageSize  Number of items per page.
     * @param  int  $page  Page number for pagination.
     * @return array<string, mixed>
     */
    public function listOrders(int $pageSize = 10, int $page = 1): array
    {
        return $this->request('GET', '/orders', [
            'limit' => $pageSize,
            'page' => $page,
        ]);
    }

    /**
     * Get a single order by ID.
     *
     * @param  int|string  $id  The order ID.
     * @return array<string, mixed>
     */
    public function getOrder(int|string $id): array
    {
        return $this->request('GET', '/orders/' . urlencode((string) $id));
    }

    /**
     * List customers.
     *
     * @param  int  $pageSize  Number of items per page.
     * @param  int  $page  Page number for pagination.
     * @return array<string, mixed>
     */
    public function listCustomers(int $pageSize = 10, int $page = 1): array
    {
        return $this->request('GET', '/customers', [
            'limit' => $pageSize,
            'page' => $page,
        ]);
    }

    /**
     * Get the currently authenticated user.
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
     * @param  string  $method  HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Sellfy API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Sellfy API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->body();
                Log::error("Sellfy API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Sellfy API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Sellfy API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Sellfy API: {$e->getMessage()}");
        }
    }
}
