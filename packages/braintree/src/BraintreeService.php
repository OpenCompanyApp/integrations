<?php

namespace OpenCompany\Integrations\Braintree;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BraintreeService
{
    public function __construct(
        private string $accessToken = '',
        private string $merchantId = '',
        private string $baseUrl = 'https://api.braintreegateway.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->merchantId);
    }

    /**
     * Get the configured merchant ID.
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * List transactions for the merchant.
     *
     * @param  int  $limit  Maximum number of transactions to return (default: 10, max: 100).
     * @param  int  $page  Page number for pagination (default: 1).
     * @param  string|null  $status  Filter by transaction status (e.g., "authorized", "submitted_for_settlement", "settled", "failed", "voided", "declined").
     * @return array<string, mixed>
     */
    public function listTransactions(int $limit = 10, int $page = 1, ?string $status = null): array
    {
        $params = ['limit' => $limit, 'page' => $page];
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', "/merchants/{$this->merchantId}/transactions", $params);
    }

    /**
     * Get a single transaction by ID.
     *
     * @param  string  $id  The transaction ID.
     * @return array<string, mixed>
     */
    public function getTransaction(string $id): array
    {
        return $this->request('GET', "/merchants/{$this->merchantId}/transactions/{$id}");
    }

    /**
     * List customers for the merchant.
     *
     * @param  int  $limit  Maximum number of customers to return (default: 10, max: 100).
     * @param  int  $page  Page number for pagination (default: 1).
     * @return array<string, mixed>
     */
    public function listCustomers(int $limit = 10, int $page = 1): array
    {
        return $this->request('GET', "/merchants/{$this->merchantId}/customers", [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single customer by ID.
     *
     * @param  string  $id  The customer ID.
     * @return array<string, mixed>
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', "/merchants/{$this->merchantId}/customers/{$id}");
    }

    /**
     * List plans for the merchant.
     *
     * @param  int  $limit  Maximum number of plans to return (default: 10, max: 100).
     * @param  int  $page  Page number for pagination (default: 1).
     * @return array<string, mixed>
     */
    public function listPlans(int $limit = 10, int $page = 1): array
    {
        return $this->request('GET', "/merchants/{$this->merchantId}/plans", [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * List subscriptions for the merchant.
     *
     * @param  int  $limit  Maximum number of subscriptions to return (default: 10, max: 100).
     * @param  int  $page  Page number for pagination (default: 1).
     * @param  string|null  $status  Filter by subscription status (e.g., "active", "past_due", "canceled", "expired").
     * @return array<string, mixed>
     */
    public function listSubscriptions(int $limit = 10, int $page = 1, ?string $status = null): array
    {
        $params = ['limit' => $limit, 'page' => $page];
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', "/merchants/{$this->merchantId}/subscriptions", $params);
    }

    /**
     * Get current merchant account info.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', "/merchants/{$this->merchantId}");
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/merchants/{id}/transactions").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Braintree API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Braintree access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Braintree API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Braintree API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Braintree API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Braintree API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Braintree API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Braintree API: {$e->getMessage()}");
        }
    }
}
