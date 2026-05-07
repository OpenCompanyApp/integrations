<?php

namespace OpenCompany\Integrations\LemonSqueezy;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Lemon Squeezy API.
 *
 * Handles bearer-token authentication, JSON:API request bodies, safe URL
 * construction, error logging, and response parsing.
 */
class LemonSqueezyService
{
    /**
     * @param  string  $apiKey  Lemon Squeezy API key.
     * @param  string  $baseUrl  Lemon Squeezy API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.lemonsqueezy.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an API key configured.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * List Lemon Squeezy products.
     *
     * @param  array<string, mixed>  $params  Extra query parameters such as filters or includes.
     * @return array<string, mixed>
     */
    public function listProducts(int $pageSize = 10, int $page = 1, array $params = []): array
    {
        return $this->listResource('products', $this->pagination($pageSize, $page, $params));
    }

    /**
     * Retrieve a Lemon Squeezy product.
     *
     * @return array<string, mixed>
     */
    public function getProduct(int|string $id): array
    {
        return $this->getResource('products', $id);
    }

    /**
     * List Lemon Squeezy orders.
     *
     * @param  array<string, mixed>  $params  Extra query parameters such as filters or includes.
     * @return array<string, mixed>
     */
    public function listOrders(int $pageSize = 10, int $page = 1, array $params = []): array
    {
        return $this->listResource('orders', $this->pagination($pageSize, $page, $params));
    }

    /**
     * Retrieve a Lemon Squeezy order.
     *
     * @return array<string, mixed>
     */
    public function getOrder(int|string $id): array
    {
        return $this->getResource('orders', $id);
    }

    /**
     * List Lemon Squeezy customers.
     *
     * @param  array<string, mixed>  $params  Extra query parameters such as filters or includes.
     * @return array<string, mixed>
     */
    public function listCustomers(int $pageSize = 10, int $page = 1, array $params = []): array
    {
        return $this->listResource('customers', $this->pagination($pageSize, $page, $params));
    }

    /**
     * List Lemon Squeezy subscriptions.
     *
     * @param  array<string, mixed>  $params  Extra query parameters such as filters or includes.
     * @return array<string, mixed>
     */
    public function listSubscriptions(int $pageSize = 10, int $page = 1, array $params = []): array
    {
        return $this->listResource('subscriptions', $this->pagination($pageSize, $page, $params));
    }

    /**
     * Retrieve the authenticated Lemon Squeezy user profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * List a Lemon Squeezy resource collection.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listResource(string $resource, array $params = []): array
    {
        return $this->request('GET', '/v1/'.$this->resource($resource), query: $params);
    }

    /**
     * Retrieve a Lemon Squeezy resource by ID.
     *
     * @return array<string, mixed>
     */
    public function getResource(string $resource, int|string $id): array
    {
        return $this->request('GET', '/v1/'.$this->resource($resource).'/'.$this->segment((string) $id));
    }

    /**
     * Create a Lemon Squeezy JSON:API resource.
     *
     * @param  array<string, mixed>  $attributes  Resource attributes.
     * @param  array<string, mixed>  $relationships  Resource relationships.
     * @return array<string, mixed>
     */
    public function createResource(string $resource, array $attributes = [], array $relationships = []): array
    {
        return $this->request('POST', '/v1/'.$this->resource($resource), body: $this->jsonApiBody($resource, $attributes, $relationships));
    }

    /**
     * Update a Lemon Squeezy JSON:API resource.
     *
     * @param  array<string, mixed>  $attributes  Resource attributes.
     * @param  array<string, mixed>  $relationships  Resource relationships.
     * @return array<string, mixed>
     */
    public function updateResource(string $resource, int|string $id, array $attributes = [], array $relationships = []): array
    {
        return $this->request('PATCH', '/v1/'.$this->resource($resource).'/'.$this->segment((string) $id), body: $this->jsonApiBody($resource, $attributes, $relationships, (string) $id));
    }

    /**
     * Delete a Lemon Squeezy resource.
     *
     * @return array<string, mixed>
     */
    public function deleteResource(string $resource, int|string $id): array
    {
        return $this->request('DELETE', '/v1/'.$this->resource($resource).'/'.$this->segment((string) $id));
    }

    /**
     * Cancel a subscription.
     *
     * @return array<string, mixed>
     */
    public function cancelSubscription(int|string $id): array
    {
        return $this->request('DELETE', '/v1/subscriptions/'.$this->segment((string) $id));
    }

    /**
     * Generate an invoice for an order.
     *
     * @param  array<string, mixed>  $payload  Invoice request body.
     * @return array<string, mixed>
     */
    public function generateOrderInvoice(int|string $id, array $payload = []): array
    {
        return $this->request('POST', '/v1/orders/'.$this->segment((string) $id).'/generate-invoice', body: $payload);
    }

    /**
     * Issue an order refund.
     *
     * @param  array<string, mixed>  $payload  Refund request body.
     * @return array<string, mixed>
     */
    public function refundOrder(int|string $id, array $payload = []): array
    {
        return $this->request('POST', '/v1/orders/'.$this->segment((string) $id).'/refund', body: $payload);
    }

    /**
     * Make a generic GET request to a safe Lemon Squeezy API path.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, query: $query);
    }

    /**
     * Make a generic POST request to a safe Lemon Squeezy API path.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, query: $query, body: $body);
    }

    /**
     * Make a generic PATCH request to a safe Lemon Squeezy API path.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PATCH', $path, query: $query, body: $body);
    }

    /**
     * Make a generic DELETE request to a safe Lemon Squeezy API path.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, query: $query);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Lemon Squeezy API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Lemon Squeezy API key is not configured.');
        }

        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->apiKey,
                'Accept' => 'application/vnd.api+json',
                'Content-Type' => 'application/vnd.api+json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'PATCH' => $http->patch($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('errors.0.detail') ?? $response->json('errors.0.title') ?? $response->json('error') ?? $response->body();
                Log::error("Lemon Squeezy API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new RuntimeException("Lemon Squeezy API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Lemon Squeezy API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Lemon Squeezy API: {$e->getMessage()}");
        }
    }

    /**
     * Build a JSON:API resource body.
     *
     * @param  array<string, mixed>  $attributes  Resource attributes.
     * @param  array<string, mixed>  $relationships  Resource relationships.
     * @return array<string, mixed>
     */
    private function jsonApiBody(string $resource, array $attributes, array $relationships = [], ?string $id = null): array
    {
        $data = ['type' => $this->resource($resource), 'attributes' => $attributes];

        if ($id !== null) {
            $data['id'] = $id;
        }

        if ($relationships !== []) {
            $data['relationships'] = $relationships;
        }

        return ['data' => $data];
    }

    /**
     * Add pagination parameters while preserving caller filters/includes.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    private function pagination(int $pageSize, int $page, array $params = []): array
    {
        return array_merge($params, [
            'page[size]' => $pageSize,
            'page[number]' => $page,
        ]);
    }

    /**
     * Build a safe URL below the configured API base.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query = []): string
    {
        if (preg_match('/^https?:\/\//i', $path) === 1 || str_contains($path, '..')) {
            throw new RuntimeException('Lemon Squeezy API path must be a safe relative path.');
        }

        $path = '/'.ltrim($path, '/');
        $queryString = $this->buildQuery($query);

        return $this->baseUrl.$path.($queryString !== '' ? '?'.$queryString : '');
    }

    /**
     * Build a query string while preserving bracketed keys and repeated array values.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildQuery(array $query): string
    {
        $pairs = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            if (is_array($value)) {
                foreach ($value as $item) {
                    $pairs[] = rawurlencode((string) $key).'='.rawurlencode(is_scalar($item) ? (string) $item : json_encode($item, JSON_THROW_ON_ERROR));
                }
                continue;
            }

            $pairs[] = rawurlencode((string) $key).'='.rawurlencode((string) $value);
        }

        return implode('&', $pairs);
    }

    /**
     * Normalize supported Lemon Squeezy resource names.
     */
    private function resource(string $resource): string
    {
        $resource = strtolower(trim($resource));
        $aliases = [
            'store' => 'stores',
            'customer' => 'customers',
            'product' => 'products',
            'variant' => 'variants',
            'price' => 'prices',
            'file' => 'files',
            'order' => 'orders',
            'order-item' => 'order-items',
            'order_item' => 'order-items',
            'subscription' => 'subscriptions',
            'subscription-invoice' => 'subscription-invoices',
            'subscription_invoice' => 'subscription-invoices',
            'subscription-item' => 'subscription-items',
            'subscription_item' => 'subscription-items',
            'usage-record' => 'usage-records',
            'usage_record' => 'usage-records',
            'discount' => 'discounts',
            'discount-redemption' => 'discount-redemptions',
            'discount_redemption' => 'discount-redemptions',
            'license-key' => 'license-keys',
            'license_key' => 'license-keys',
            'license-key-instance' => 'license-key-instances',
            'license_key_instance' => 'license-key-instances',
            'checkout' => 'checkouts',
            'webhook' => 'webhooks',
        ];

        $resource = $aliases[$resource] ?? $resource;
        $allowed = [
            'stores', 'customers', 'products', 'variants', 'prices', 'files',
            'orders', 'order-items', 'subscriptions', 'subscription-invoices',
            'subscription-items', 'usage-records', 'discounts',
            'discount-redemptions', 'license-keys', 'license-key-instances',
            'checkouts', 'webhooks',
        ];

        if (!in_array($resource, $allowed, true)) {
            throw new RuntimeException('Unsupported Lemon Squeezy resource: '.$resource);
        }

        return $resource;
    }

    /**
     * URL encode one path segment.
     */
    private function segment(string $value): string
    {
        return rawurlencode($value);
    }
}
