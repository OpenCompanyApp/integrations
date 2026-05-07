<?php

namespace OpenCompany\Integrations\Etsy;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for Etsy Open API v3.
 *
 * Handles OAuth bearer authentication, Etsy app key headers, JSON and multipart
 * requests, and normalized error reporting for shop, listing, receipt, and
 * taxonomy tools.
 */
class EtsyService
{
    /**
     * @param  string  $accessToken  Etsy OAuth access token.
     * @param  string  $shopId  Etsy shop ID.
     * @param  string  $baseUrl  Etsy Open API base URL.
     * @param  string  $apiKey  Etsy app keystring for the x-api-key header.
     */
    public function __construct(
        private string $accessToken = '',
        private string $shopId = '',
        private string $baseUrl = 'https://openapi.etsy.com/v3/application',
        private string $apiKey = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    public function getShopId(): string
    {
        return $this->shopId;
    }

    /**
     * Get the configured shop.
     *
     * @return array<string, mixed>
     */
    public function getShop(): array
    {
        return $this->request('GET', "/shops/{$this->requireShopId()}");
    }

    /**
     * List listings for the configured shop.
     *
     * @param  array<string, mixed>  $params  Query parameters such as state, limit, offset, sort_on, sort_order.
     * @return array<string, mixed>
     */
    public function listListings(array $params = []): array
    {
        return $this->request('GET', "/shops/{$this->requireShopId()}/listings", $params);
    }

    /**
     * Get a single listing by ID.
     *
     * @param  int  $listingId  Etsy listing ID.
     * @return array<string, mixed>
     */
    public function getListing(int $listingId): array
    {
        return $this->request('GET', "/listings/{$listingId}");
    }

    /**
     * Create a draft listing in the configured shop.
     *
     * @param  array<string, mixed>  $data  Listing creation payload.
     * @return array<string, mixed>
     */
    public function createListing(array $data): array
    {
        return $this->request('POST', "/shops/{$this->requireShopId()}/listings", $data);
    }

    /**
     * Update a listing in the configured shop.
     *
     * @param  int  $listingId  Etsy listing ID.
     * @param  array<string, mixed>  $data  Listing update payload.
     * @return array<string, mixed>
     */
    public function updateListing(int $listingId, array $data): array
    {
        return $this->request('PUT', "/shops/{$this->requireShopId()}/listings/{$listingId}", $data);
    }

    /**
     * Delete a listing from the configured shop.
     *
     * @param  int  $listingId  Etsy listing ID.
     * @return array<string, mixed>
     */
    public function deleteListing(int $listingId): array
    {
        return $this->request('DELETE', "/shops/{$this->requireShopId()}/listings/{$listingId}");
    }

    /**
     * List listing images.
     *
     * @param  int  $listingId  Etsy listing ID.
     * @return array<string, mixed>
     */
    public function listListingImages(int $listingId): array
    {
        return $this->request('GET', "/shops/{$this->requireShopId()}/listings/{$listingId}/images");
    }

    /**
     * Upload an image to a listing.
     *
     * @param  int  $listingId  Etsy listing ID.
     * @param  string  $imagePath  Local image file path.
     * @param  array<string, mixed>  $fields  Multipart form fields such as rank, overwrite, alt_text.
     * @return array<string, mixed>
     */
    public function uploadListingImage(int $listingId, string $imagePath, array $fields = []): array
    {
        if (!is_file($imagePath)) {
            throw new \InvalidArgumentException('A valid image_path is required.');
        }

        return $this->jsonResponse($this->multipartRequest(
            'POST',
            "/shops/{$this->requireShopId()}/listings/{$listingId}/images",
            'image',
            $imagePath,
            $fields
        ));
    }

    /**
     * Get the inventory for a specific listing.
     *
     * @param  int  $listingId  Etsy listing ID.
     * @return array<string, mixed>
     */
    public function getListingInventory(int $listingId): array
    {
        return $this->request('GET', "/listings/{$listingId}/inventory");
    }

    /**
     * Update the inventory for a listing.
     *
     * @param  int  $listingId  Etsy listing ID.
     * @param  array<string, mixed>  $data  Inventory payload with products and price_on_property/quantity_on_property/sku_on_property.
     * @return array<string, mixed>
     */
    public function updateListingInventory(int $listingId, array $data): array
    {
        return $this->request('PUT', "/listings/{$listingId}/inventory", $data);
    }

    /**
     * List orders/receipts for the configured shop.
     *
     * @param  array<string, mixed>  $params  Query parameters such as limit, offset, was_paid, was_shipped.
     * @return array<string, mixed>
     */
    public function listOrders(array $params = []): array
    {
        return $this->request('GET', "/shops/{$this->requireShopId()}/receipts", $params);
    }

    /**
     * Get one shop receipt.
     *
     * @param  int  $receiptId  Etsy receipt ID.
     * @return array<string, mixed>
     */
    public function getReceipt(int $receiptId): array
    {
        return $this->request('GET', "/shops/{$this->requireShopId()}/receipts/{$receiptId}");
    }

    /**
     * List transactions for one receipt.
     *
     * @param  int  $receiptId  Etsy receipt ID.
     * @return array<string, mixed>
     */
    public function listReceiptTransactions(int $receiptId): array
    {
        return $this->request('GET', "/shops/{$this->requireShopId()}/receipts/{$receiptId}/transactions");
    }

    /**
     * List shop sections.
     *
     * @return array<string, mixed>
     */
    public function listShopSections(): array
    {
        return $this->request('GET', "/shops/{$this->requireShopId()}/sections");
    }

    /**
     * List shop shipping profiles.
     *
     * @return array<string, mixed>
     */
    public function listShippingProfiles(): array
    {
        return $this->request('GET', "/shops/{$this->requireShopId()}/shipping-profiles");
    }

    /**
     * List seller taxonomy nodes.
     *
     * @return array<string, mixed>
     */
    public function listSellerTaxonomyNodes(): array
    {
        return $this->request('GET', '/seller-taxonomy/nodes');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Call a documented Etsy Open API GET endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v3/application.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * Call a documented Etsy Open API POST endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v3/application.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $path, $body);
    }

    /**
     * Call a documented Etsy Open API PUT endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v3/application.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = []): array
    {
        return $this->request('PUT', $path, $body);
    }

    /**
     * Call a documented Etsy Open API DELETE endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v3/application.
     * @param  array<string, mixed>  $body  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $path, $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        return $this->jsonResponse($this->rawRequest($method, $path, $data));
    }

    /**
     * Make a raw JSON HTTP request to the Etsy Open API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        $this->assertConfigured();

        $url = $this->url($path);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'x-api-key' => $this->etsyApiKey(),
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
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Etsy API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Etsy API: {$e->getMessage()}");
        }
    }

    /**
     * Make a multipart HTTP request to the Etsy Open API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  string  $fileField  Multipart file field name.
     * @param  string  $filePath  Local file path.
     * @param  array<string, mixed>  $fields  Multipart form fields.
     * @return Response
     */
    private function multipartRequest(string $method, string $path, string $fileField, string $filePath, array $fields = []): Response
    {
        $this->assertConfigured();

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'x-api-key' => $this->etsyApiKey(),
                'Accept' => 'application/json',
            ])->attach($fileField, file_get_contents($filePath), basename($filePath))->timeout(60);

            $response = match (strtoupper($method)) {
                'POST' => $http->post($this->url($path), array_filter($fields, static fn ($value): bool => $value !== null && $value !== '')),
                default => throw new \RuntimeException("Unsupported multipart HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Etsy API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Etsy API: {$e->getMessage()}");
        }
    }

    /**
     * Return parsed JSON from a response.
     *
     * @return array<string, mixed>
     */
    private function jsonResponse(Response $response): array
    {
        return $response->json() ?? [];
    }

    /**
     * Build the full request URL.
     */
    private function url(string $path): string
    {
        return $this->baseUrl . '/' . $this->normalizePath($path);
    }

    /**
     * Normalize a relative API path and reject absolute URLs.
     */
    private function normalizePath(string $path): string
    {
        $path = ltrim(trim($path), '/');

        if ($path === '') {
            throw new \InvalidArgumentException('Etsy API path is required.');
        }

        if (preg_match('#^https?://#i', $path) === 1) {
            throw new \InvalidArgumentException('Use an Etsy API path relative to the configured base URL.');
        }

        return $path;
    }

    /**
     * Return the x-api-key value, keeping backwards compatibility with old single-secret configs.
     */
    private function etsyApiKey(): string
    {
        return $this->apiKey !== '' ? $this->apiKey : $this->accessToken;
    }

    /**
     * Ensure the access token exists.
     */
    private function assertConfigured(): void
    {
        if ($this->accessToken === '') {
            throw new \RuntimeException('Etsy access token is not configured.');
        }
    }

    /**
     * Ensure the shop ID exists.
     */
    private function requireShopId(): string
    {
        if ($this->shopId === '') {
            throw new \RuntimeException('Etsy shop ID is not configured.');
        }

        return rawurlencode($this->shopId);
    }

    /**
     * Throw a normalized API exception.
     *
     * @throws \RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = (string) $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Etsy API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);
            throw new \RuntimeException("Etsy API returned an unexpected response (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
        }

        $error = $response->json('error') ?? $response->json('message') ?? $body;
        Log::error("Etsy API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);
        throw new \RuntimeException("Etsy API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
