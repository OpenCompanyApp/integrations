<?php

namespace OpenCompany\Integrations\Gumroad;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GumroadService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.gumroad.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all products.
     *
     * @return array<string, mixed>
     */
    public function listProducts(): array
    {
        return $this->request('GET', '/products');
    }

    /**
     * Get a single product by ID.
     *
     * @return array<string, mixed>
     */
    public function getProduct(string $productId): array
    {
        return $this->request('GET', '/products/' . urlencode($productId));
    }

    /**
     * List sales, optionally filtered.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listSales(array $params = []): array
    {
        return $this->request('GET', '/sales', $params);
    }

    /**
     * List all subscribers, optionally filtered by product.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listSubscribers(array $params = []): array
    {
        return $this->request('GET', '/subscribers', $params);
    }

    /**
     * Get a single subscriber by ID.
     *
     * @return array<string, mixed>
     */
    public function getSubscriber(string $subscriberId): array
    {
        return $this->request('GET', '/subscribers/' . urlencode($subscriberId));
    }

    /**
     * List all offers.
     *
     * @return array<string, mixed>
     */
    public function listOffers(): array
    {
        return $this->request('GET', '/offers');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Gumroad API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Gumroad access token is not configured.');
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
                    Log::warning("Gumroad API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Gumroad API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Gumroad API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Gumroad API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Gumroad API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Gumroad API: {$e->getMessage()}");
        }
    }
}
