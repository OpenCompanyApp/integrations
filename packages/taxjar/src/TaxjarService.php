<?php

namespace OpenCompany\Integrations\Taxjar;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * TaxJar API service for sales tax calculation, collection, and reporting.
 *
 * Communicates with the TaxJar REST API v2 using Bearer token authentication.
 * Supports multi-account configuration via constructor injection.
 *
 * Base URL: {@see https://api.taxjar.com/v2}
 */
class TaxjarService
{
    /**
     * Create a new TaxjarService instance.
     *
     * @param  string  $accessToken  TaxJar API access token for Bearer authentication.
     * @param  string  $baseUrl      Optional override for the base URL (default: https://api.taxjar.com/v2).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.taxjar.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->baseUrl);
    }

    /**
     * Get the configured base URL for the TaxJar API.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Retrieve the current authenticated user's information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * List order transactions with optional filtering and pagination.
     *
     * @param  string|null  $fromDate   Filter by start date (ISO 8601 format, e.g. 2024-01-01).
     * @param  string|null  $toDate     Filter by end date (ISO 8601 format, e.g. 2024-12-31).
     * @param  int|null     $limit      Number of results per page.
     * @param  int|null     $offset     Offset for pagination.
     * @return array<string, mixed>
     */
    public function listOrders(?string $fromDate = null, ?string $toDate = null, ?int $limit = null, ?int $offset = null): array
    {
        $params = [];
        if ($fromDate !== null) {
            $params['from_transaction_date'] = $fromDate;
        }
        if ($toDate !== null) {
            $params['to_transaction_date'] = $toDate;
        }
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/transactions/orders', $params);
    }

    /**
     * Retrieve a single order transaction by ID.
     *
     * @param  string  $id  The order transaction ID.
     * @return array<string, mixed>
     */
    public function getOrder(string $id): array
    {
        return $this->request('GET', '/transactions/orders/' . urlencode($id));
    }

    /**
     * List refund transactions with optional filtering and pagination.
     *
     * @param  string|null  $fromDate   Filter by start date (ISO 8601 format).
     * @param  string|null  $toDate     Filter by end date (ISO 8601 format).
     * @param  int|null     $limit      Number of results per page.
     * @param  int|null     $offset     Offset for pagination.
     * @return array<string, mixed>
     */
    public function listRefunds(?string $fromDate = null, ?string $toDate = null, ?int $limit = null, ?int $offset = null): array
    {
        $params = [];
        if ($fromDate !== null) {
            $params['from_transaction_date'] = $fromDate;
        }
        if ($toDate !== null) {
            $params['to_transaction_date'] = $toDate;
        }
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/transactions/refunds', $params);
    }

    /**
     * List all transactions (orders and refunds) with optional filtering and pagination.
     *
     * @param  string|null  $fromDate   Filter by start date (ISO 8601 format).
     * @param  string|null  $toDate     Filter by end date (ISO 8601 format).
     * @param  int|null     $limit      Number of results per page.
     * @param  int|null     $offset     Offset for pagination.
     * @return array<string, mixed>
     */
    public function listTransactions(?string $fromDate = null, ?string $toDate = null, ?int $limit = null, ?int $offset = null): array
    {
        $params = [];
        if ($fromDate !== null) {
            $params['from_transaction_date'] = $fromDate;
        }
        if ($toDate !== null) {
            $params['to_transaction_date'] = $toDate;
        }
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/transactions', $params);
    }

    /**
     * Retrieve a single transaction by ID.
     *
     * @param  string  $id  The transaction ID.
     * @return array<string, mixed>
     */
    public function getTransaction(string $id): array
    {
        return $this->request('GET', '/transactions/' . urlencode($id));
    }

    /**
     * List tax categories.
     *
     * @return array<string, mixed>
     */
    public function listCategories(): array
    {
        return $this->request('GET', '/categories');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string               $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string               $path    API endpoint path (e.g., /transactions/orders).
     * @param  array<string, mixed> $data    Query parameters or form data.
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
     * Make a raw HTTP request to the TaxJar API.
     *
     * Uses Bearer token authentication with the configured access token.
     *
     * @param  string               $method  HTTP method.
     * @param  string               $path    API endpoint path.
     * @param  array<string, mixed> $data    Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing, or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken || !$this->baseUrl) {
            throw new \RuntimeException('TaxJar access token is not configured.');
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
                $error = $response->json('message') ?? $response->body();
                Log::error("TaxJar API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("TaxJar API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("TaxJar API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to TaxJar API: {$e->getMessage()}");
        }
    }
}
