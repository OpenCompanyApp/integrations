<?php

namespace OpenCompany\Integrations\Gumroad;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Gumroad API v2.
 *
 * Handles bearer-token authentication, request dispatch, error logging, and
 * response parsing for all Gumroad tools.
 */
class GumroadService
{
    /**
     * @param  string  $accessToken  Gumroad OAuth access token.
     * @param  string  $baseUrl  Gumroad API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.gumroad.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * List products.
     *
     * @return array<string, mixed>
     */
    public function listProducts(): array
    {
        return $this->apiGet('/products');
    }

    /**
     * Get a product by ID.
     *
     * @return array<string, mixed>
     */
    public function getProduct(string $productId): array
    {
        return $this->apiGet('/products/' . rawurlencode($productId));
    }

    /**
     * List sales.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listSales(array $params = []): array
    {
        return $this->apiGet('/sales', $params);
    }

    /**
     * List subscribers.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listSubscribers(array $params = []): array
    {
        return $this->apiGet('/subscribers', $params);
    }

    /**
     * Get a subscriber by ID.
     *
     * @return array<string, mixed>
     */
    public function getSubscriber(string $subscriberId): array
    {
        return $this->apiGet('/subscribers/' . rawurlencode($subscriberId));
    }

    /**
     * List offers.
     *
     * @return array<string, mixed>
     */
    public function listOffers(): array
    {
        return $this->apiGet('/offers');
    }

    /**
     * Get the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/user');
    }

    /**
     * Send a GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Send a POST request.
     *
     * @param  array<string, mixed>  $data  Request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $data = [], array $query = []): array
    {
        return $this->request('POST', $path, $data, $query);
    }

    /**
     * Send a PUT request.
     *
     * @param  array<string, mixed>  $data  Request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PUT', $path, $data, $query);
    }

    /**
     * Send a DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    /**
     * Make an API request and return parsed JSON.
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
     * Make a raw HTTP request.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        if (!$this->accessToken) {
            throw new RuntimeException('Gumroad access token is not configured.');
        }

        $url = $this->baseUrl . '/' . ltrim($path, '/');

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                $body = $response->body();
                $json = $response->json();
                $error = is_array($json) ? ($json['error'] ?? $json['message'] ?? $json['errors'] ?? $body) : $body;
                $errorMessage = is_string($error) ? $error : json_encode($error);

                Log::error("Gumroad API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $errorMessage,
                ]);

                throw new RuntimeException("Gumroad API error ({$response->status()}): {$errorMessage}");
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Gumroad API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Gumroad API: {$e->getMessage()}");
        }
    }
}