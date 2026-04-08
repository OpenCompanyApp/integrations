<?php

namespace OpenCompany\Integrations\Etsy;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EtsyService
{
    public function __construct(
        private string $accessToken = '',
        private string $shopId = '',
        private string $baseUrl = 'https://openapi.etsy.com/v3/application',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Etsy integration is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the configured shop ID.
     */
    public function getShopId(): string
    {
        return $this->shopId;
    }

    /**
     * List listings for the configured shop.
     *
     * @param array{state?: string, limit?: int, offset?: int} $params
     * @return array
     */
    public function listListings(array $params = []): array
    {
        return $this->request('GET', "/shops/{$this->shopId}/listings", $params);
    }

    /**
     * Get a single listing by ID.
     */
    public function getListing(int $listingId): array
    {
        return $this->request('GET', "/listings/{$listingId}");
    }

    /**
     * Create a new listing in the configured shop.
     *
     * @param array{title: string, description: string, price: float, quantity: int, shipping_profile_id: int, taxonomy_id?: int, tags?: string[], who_made?: string, when_made?: string, is_supply?: bool} $data
     * @return array
     */
    public function createListing(array $data): array
    {
        return $this->request('POST', "/shops/{$this->shopId}/listings", $data);
    }

    /**
     * List orders (receipts) for the configured shop.
     *
     * @param array{limit?: int, offset?: int, was_paid?: bool, was_shipped?: bool} $params
     * @return array
     */
    public function listOrders(array $params = []): array
    {
        return $this->request('GET', "/shops/{$this->shopId}/receipts", $params);
    }

    /**
     * Get the inventory for a specific listing.
     */
    public function getListingInventory(int $listingId): array
    {
        return $this->request('GET', "/listings/{$listingId}/inventory");
    }

    /**
     * Get the currently authenticated user.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method  HTTP method (GET, POST, PUT, DELETE)
     * @param string $path    API endpoint path (e.g. "/listings/123")
     * @param array  $data    Query parameters or request body
     * @return array          Parsed JSON response
     *
     * @throws \RuntimeException on configuration, connection, or API errors
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Etsy Open API.
     *
     * @param string $method  HTTP method (GET, POST, PUT, DELETE)
     * @param string $path    API endpoint path
     * @param array  $data    Query parameters or request body
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException on configuration, connection, or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Etsy access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'x-api-key' => $this->accessToken,
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
                    Log::warning("Etsy API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Etsy API returned an unexpected response (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Etsy API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Etsy API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Etsy API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Etsy API: {$e->getMessage()}");
        }
    }
}
