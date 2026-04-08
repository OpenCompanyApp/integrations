<?php

namespace OpenCompany\Integrations\ShipBob;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShipBobService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.shipbob.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List orders with optional pagination and status filtering.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Results per page.
     * @param  string|null  $status  Filter by order status (e.g. "pending", "fulfilled", "cancelled").
     * @return array<string, mixed>
     */
    public function listOrders(int $page = 1, int $limit = 25, ?string $status = null): array
    {
        $params = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/v2/orders', $params);
    }

    /**
     * Get a single order by ID.
     *
     * @param  int  $orderId  The ShipBob order ID.
     * @return array<string, mixed>
     */
    public function getOrder(int $orderId): array
    {
        return $this->request('GET', '/v2/orders/' . $orderId);
    }

    /**
     * Create a new order.
     *
     * @param  string  $receivingNote  Note for the fulfillment center.
     * @param  array<int, array<string, mixed>>  $products  List of product line items.
     * @param  string|null  $shippingMethod  Desired shipping method.
     * @return array<string, mixed>
     */
    public function createOrder(string $receivingNote, array $products, ?string $shippingMethod = null): array
    {
        $body = [
            'receiving_note' => $receivingNote,
            'products' => $products,
        ];

        if ($shippingMethod !== null) {
            $body['shipping_method'] = $shippingMethod;
        }

        return $this->request('POST', '/v2/orders', $body);
    }

    /**
     * List products with optional pagination.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Results per page.
     * @return array<string, mixed>
     */
    public function listProducts(int $page = 1, int $limit = 25): array
    {
        return $this->request('GET', '/v2/products', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get a single product by ID.
     *
     * @param  int  $productId  The ShipBob product ID.
     * @return array<string, mixed>
     */
    public function getProduct(int $productId): array
    {
        return $this->request('GET', '/v2/products/' . $productId);
    }

    /**
     * List shipments with optional pagination.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Results per page.
     * @return array<string, mixed>
     */
    public function listShipments(int $page = 1, int $limit = 25): array
    {
        return $this->request('GET', '/v2/shipments', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the ShipBob API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('ShipBob access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                    Log::warning("ShipBob API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("ShipBob API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("ShipBob API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("ShipBob API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ShipBob API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ShipBob API: {$e->getMessage()}");
        }
    }
}
