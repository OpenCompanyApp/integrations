<?php

namespace OpenCompany\Integrations\Chargebee;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Chargebee API service for managing subscriptions, customers, and invoices.
 *
 * Communicates with the Chargebee REST API v2 using Bearer token authentication.
 * Supports multi-account configuration via constructor injection.
 *
 * The base URL is constructed as {@see https://{site_name}.chargebee.com/api/v2}
 * using the configured site name.
 */
class ChargebeeService
{
    /**
     * Create a new ChargebeeService instance.
     *
     * @param  string  $accessToken  Chargebee API access token for Bearer authentication.
     * @param  string  $siteName     Chargebee site name (subdomain in the API URL).
     * @param  string  $baseUrl      Optional override for the base URL scheme (default: https://{site}.chargebee.com).
     */
    public function __construct(
        private string $accessToken = '',
        private string $siteName = '',
        private string $baseUrl = '',
    ) {
        if (empty($this->baseUrl) && !empty($this->siteName)) {
            $this->baseUrl = "https://{$this->siteName}.chargebee.com/api/v2";
        }
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token and site name.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->baseUrl);
    }

    /**
     * Get the configured base URL for the Chargebee API.
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
     * List subscriptions with optional filtering and pagination.
     *
     * @param  int|null     $limit  Number of results per page (max 100).
     * @param  string|null  $page   Pagination cursor from a previous response.
     * @param  string|null  $state  Filter by subscription state: active, cancelled, non_renewing, paused, in_trial, future.
     * @return array<string, mixed>
     */
    public function listSubscriptions(?int $limit = null, ?string $page = null, ?string $state = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($page !== null) {
            $params['offset'] = $page;
        }
        if ($state !== null) {
            $params['status[is]'] = $state;
        }

        return $this->request('GET', '/subscriptions', $params);
    }

    /**
     * Retrieve a single subscription by ID.
     *
     * @param  string  $id  The subscription ID.
     * @return array<string, mixed>
     */
    public function getSubscription(string $id): array
    {
        return $this->request('GET', '/subscriptions/' . urlencode($id));
    }

    /**
     * List customers with optional pagination.
     *
     * @param  int|null      $limit  Number of results per page (max 100).
     * @param  string|null   $page   Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listCustomers(?int $limit = null, ?string $page = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($page !== null) {
            $params['offset'] = $page;
        }

        return $this->request('GET', '/customers', $params);
    }

    /**
     * Retrieve a single customer by ID.
     *
     * @param  string  $id  The customer ID.
     * @return array<string, mixed>
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', '/customers/' . urlencode($id));
    }

    /**
     * List invoices with optional filtering and pagination.
     *
     * @param  int|null      $limit   Number of results per page (max 100).
     * @param  string|null   $page    Pagination cursor from a previous response.
     * @param  string|null   $status  Filter by invoice status: paid, posted, payment_due, not_paid, voided, pending.
     * @return array<string, mixed>
     */
    public function listInvoices(?int $limit = null, ?string $page = null, ?string $status = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($page !== null) {
            $params['offset'] = $page;
        }
        if ($status !== null) {
            $params['status[is]'] = $status;
        }

        return $this->request('GET', '/invoices', $params);
    }

    /**
     * Retrieve a single invoice by ID.
     *
     * @param  string  $id  The invoice ID.
     * @return array<string, mixed>
     */
    public function getInvoice(string $id): array
    {
        return $this->request('GET', '/invoices/' . urlencode($id));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string               $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string               $path    API endpoint path (e.g., /subscriptions).
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
     * Make a raw HTTP request to the Chargebee API.
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
            throw new \RuntimeException('Chargebee access token and site name are not configured.');
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
                Log::error("Chargebee API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Chargebee API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Chargebee API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Chargebee API: {$e->getMessage()}");
        }
    }
}
