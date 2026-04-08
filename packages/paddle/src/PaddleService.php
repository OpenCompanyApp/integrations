<?php

namespace OpenCompany\Integrations\Paddle;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaddleService
{
    /**
     * Create a new Paddle service instance.
     *
     * @param  string  $accessToken  Paddle API bearer token.
     * @param  string  $baseUrl      Base URL for the Paddle API (sandbox or production).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://sandbox-api.paddle.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List transactions.
     *
     * @param  int|null       $limit      Number of results per page.
     * @param  string|null    $after      Cursor for pagination.
     * @param  string|null    $status     Filter by status (e.g. "completed", "pending", "billed").
     * @param  string|null    $customerId Filter by customer ID.
     * @return array<string, mixed>
     */
    public function listTransactions(
        ?int $limit = null,
        ?string $after = null,
        ?string $status = null,
        ?string $customerId = null,
    ): array {
        $params = [];
        if ($limit !== null) {
            $params['per_page'] = $limit;
        }
        if ($after !== null) {
            $params['after'] = $after;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }
        if ($customerId !== null) {
            $params['customer_id'] = $customerId;
        }

        return $this->request('GET', '/transactions', $params);
    }

    /**
     * Get a single transaction by ID.
     *
     * @param  string  $id  Transaction ID.
     * @return array<string, mixed>
     */
    public function getTransaction(string $id): array
    {
        return $this->request('GET', '/transactions/' . urlencode($id));
    }

    /**
     * List customers.
     *
     * @param  int|null     $limit  Number of results per page.
     * @param  string|null  $after  Cursor for pagination.
     * @param  string|null  $email  Filter by email address.
     * @param  string|null  $name   Filter by customer name.
     * @return array<string, mixed>
     */
    public function listCustomers(
        ?int $limit = null,
        ?string $after = null,
        ?string $email = null,
        ?string $name = null,
    ): array {
        $params = [];
        if ($limit !== null) {
            $params['per_page'] = $limit;
        }
        if ($after !== null) {
            $params['after'] = $after;
        }
        if ($email !== null) {
            $params['email'] = $email;
        }
        if ($name !== null) {
            $params['name'] = $name;
        }

        return $this->request('GET', '/customers', $params);
    }

    /**
     * Get a single customer by ID.
     *
     * @param  string  $id  Customer ID.
     * @return array<string, mixed>
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', '/customers/' . urlencode($id));
    }

    /**
     * Create a new customer.
     *
     * @param  string       $email  Customer email address (required).
     * @param  string|null  $name   Customer name (optional).
     * @return array<string, mixed>
     */
    public function createCustomer(string $email, ?string $name = null): array
    {
        $data = ['email' => $email];
        if ($name !== null) {
            $data['name'] = $name;
        }

        return $this->request('POST', '/customers', $data);
    }

    /**
     * List products.
     *
     * @param  int|null     $limit   Number of results per page.
     * @param  string|null  $after   Cursor for pagination.
     * @param  string|null  $status  Filter by status (e.g. "active").
     * @return array<string, mixed>
     */
    public function listProducts(
        ?int $limit = null,
        ?string $after = null,
        ?string $status = null,
    ): array {
        $params = [];
        if ($limit !== null) {
            $params['per_page'] = $limit;
        }
        if ($after !== null) {
            $params['after'] = $after;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/products', $params);
    }

    /**
     * Perform a health check by fetching a single transaction.
     *
     * @return array<string, mixed>
     */
    public function healthCheck(): array
    {
        return $this->request('GET', '/transactions', ['per_page' => 1]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string               $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string               $path    API path (e.g. "/transactions").
     * @param  array<string, mixed> $data    Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Paddle API.
     *
     * @param  string               $method  HTTP method.
     * @param  string               $path    API path.
     * @param  array<string, mixed> $data    Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Paddle access token is not configured.');
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
                    Log::warning("Paddle API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Paddle API endpoint not available (HTTP {$response->status()}). Check your API URL and credentials.");
                }

                $json = $response->json();
                $error = $json['error']['detail'] ?? $json['error']['message'] ?? $body;
                Log::error("Paddle API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Paddle API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Paddle API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Paddle API: {$e->getMessage()}");
        }
    }
}
