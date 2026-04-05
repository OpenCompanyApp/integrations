<?php

namespace OpenCompany\Integrations\Shopify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Shopify Admin REST API service for making requests to the Shopify platform.
 *
 * Handles authentication via X-Shopify-Access-Token header and provides methods
 * for managing products, orders, customers, inventory, and other Shopify resources.
 */
class ShopifyService
{
    /**
     * Build the base URL from the shop name.
     */
    private function baseUrl(): string
    {
        return "https://{$this->shopName}.myshopify.com/admin/api/2025-01";
    }

    /**
     * @param  string  $accessToken  Shopify access token from OAuth or custom app
     * @param  string  $shopName     Shopify store name (the subdomain before .myshopify.com)
     */
    public function __construct(
        private string $accessToken = '',
        private string $shopName = '',
    ) {}

    /**
     * Check whether the service has both required credentials configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken) && ! empty($this->shopName);
    }

    // ── Products ───────────────────────────────────────────

    /**
     * Create a new product.
     *
     * @param  array<string, mixed>  $data  Product attributes (title, body_html, vendor, etc.)
     * @return array<string, mixed>
     */
    public function createProduct(array $data): array
    {
        return $this->request('POST', '/products.json', ['product' => $data]);
    }

    /**
     * Get a product by ID.
     *
     * @return array<string, mixed>
     */
    public function getProduct(string $id): array
    {
        return $this->request('GET', "/products/{$id}.json");
    }

    /**
     * Update a product.
     *
     * @param  array<string, mixed>  $data  Product attributes to update
     * @return array<string, mixed>
     */
    public function updateProduct(string $id, array $data): array
    {
        return $this->request('PUT', "/products/{$id}.json", ['product' => $data]);
    }

    /**
     * List products with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, status, product_type, vendor, collection_id, page_info)
     * @return array<string, mixed>
     */
    public function listProducts(array $params = []): array
    {
        return $this->request('GET', '/products.json', $params);
    }

    /**
     * Delete a product by ID.
     *
     * @return array<string, mixed>
     */
    public function deleteProduct(string $id): array
    {
        return $this->request('DELETE', "/products/{$id}.json");
    }

    // ── Orders ─────────────────────────────────────────────

    /**
     * Create a new order.
     *
     * @param  array<string, mixed>  $data  Order attributes (line_items, customer, financial_status, etc.)
     * @return array<string, mixed>
     */
    public function createOrder(array $data): array
    {
        return $this->request('POST', '/orders.json', ['order' => $data]);
    }

    /**
     * Get an order by ID.
     *
     * @return array<string, mixed>
     */
    public function getOrder(string $id): array
    {
        return $this->request('GET', "/orders/{$id}.json");
    }

    /**
     * List orders with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, status, financial_status, fulfillment_status, page_info)
     * @return array<string, mixed>
     */
    public function listOrders(array $params = []): array
    {
        return $this->request('GET', '/orders.json', $params);
    }

    /**
     * Update an order.
     *
     * @param  array<string, mixed>  $data  Order attributes to update
     * @return array<string, mixed>
     */
    public function updateOrder(string $id, array $data): array
    {
        return $this->request('PUT', "/orders/{$id}.json", ['order' => $data]);
    }

    /**
     * Cancel an order.
     *
     * @param  array<string, mixed>  $params  Cancellation parameters (reason)
     * @return array<string, mixed>
     */
    public function cancelOrder(string $id, array $params = []): array
    {
        return $this->request('POST', "/orders/{$id}/cancel.json", $params);
    }

    // ── Customers ──────────────────────────────────────────

    /**
     * Create a new customer.
     *
     * @param  array<string, mixed>  $data  Customer attributes (first_name, last_name, email, phone, tags)
     * @return array<string, mixed>
     */
    public function createCustomer(array $data): array
    {
        return $this->request('POST', '/customers.json', ['customer' => $data]);
    }

    /**
     * Get a customer by ID.
     *
     * @return array<string, mixed>
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', "/customers/{$id}.json");
    }

    /**
     * List customers with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, email, tag, page_info)
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers.json', $params);
    }

    /**
     * Update a customer.
     *
     * @param  array<string, mixed>  $data  Customer attributes to update
     * @return array<string, mixed>
     */
    public function updateCustomer(string $id, array $data): array
    {
        return $this->request('PUT', "/customers/{$id}.json", ['customer' => $data]);
    }

    // ── Draft Orders ───────────────────────────────────────

    /**
     * Create a draft order.
     *
     * @param  array<string, mixed>  $data  Draft order attributes (line_items, customer, note)
     * @return array<string, mixed>
     */
    public function createDraftOrder(array $data): array
    {
        return $this->request('POST', '/draft_orders.json', ['draft_order' => $data]);
    }

    // ── Inventory ──────────────────────────────────────────

    /**
     * List inventory items.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, page_info, ids)
     * @return array<string, mixed>
     */
    public function listInventoryItems(array $params = []): array
    {
        return $this->request('GET', '/inventory_items.json', $params);
    }

    /**
     * Set an inventory level.
     *
     * @param  array<string, mixed>  $data  Level data (inventory_item_id, location_id, available)
     * @return array<string, mixed>
     */
    public function setInventoryLevel(array $data): array
    {
        return $this->request('POST', '/inventory_levels/set.json', $data);
    }

    // ── Locations ──────────────────────────────────────────

    /**
     * List all locations.
     *
     * @return array<string, mixed>
     */
    public function listLocations(): array
    {
        return $this->request('GET', '/locations.json');
    }

    // ── Collections ────────────────────────────────────────

    /**
     * Create a custom collection.
     *
     * @param  array<string, mixed>  $data  Collection attributes (title, body_html)
     * @return array<string, mixed>
     */
    public function createCustomCollection(array $data): array
    {
        return $this->request('POST', '/custom_collections.json', ['custom_collection' => $data]);
    }

    // ── Fulfillments ───────────────────────────────────────

    /**
     * List fulfillments for an order.
     *
     * @return array<string, mixed>
     */
    public function listFulfillments(string $orderId): array
    {
        return $this->request('GET', "/orders/{$orderId}/fulfillments.json");
    }

    // ── Shop ───────────────────────────────────────────────

    /**
     * Get shop information (used for connection testing).
     *
     * @return array<string, mixed>
     */
    public function getShop(): array
    {
        return $this->request('GET', '/shop.json');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to the Shopify Admin REST API.
     *
     * Uses X-Shopify-Access-Token header for authentication.
     * For GET requests, data is passed as query parameters.
     * For POST/PUT requests, data is sent as JSON body.
     *
     * @param  array<string, mixed>  $data  Request body or query parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Shopify integration is not configured. Access token and shop name are required.');
        }

        try {
            $http = Http::withHeaders([
                'X-Shopify-Access-Token' => $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $url = $this->baseUrl() . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $json = $response->json() ?? [];

            if (! $response->successful()) {
                $errors = $json['errors'] ?? $response->body();

                Log::error("Shopify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'errors' => $errors,
                ]);

                $msg = is_string($errors) ? $errors : json_encode($errors);

                throw new \RuntimeException('Shopify API error (' . $response->status() . '): ' . $msg);
            }

            return $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Shopify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Shopify API: {$e->getMessage()}");
        }
    }
}
