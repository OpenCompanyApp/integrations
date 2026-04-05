<?php

namespace OpenCompany\Integrations\Zuora;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Zuora REST API v2 service client.
 *
 * Handles authenticated HTTP requests to the Zuora subscription management API.
 * Supports Bearer token authentication and configurable base URL for different
 * Zuora environments (US cloud, EU cloud, sandbox, etc.).
 */
class ZuoraService
{
    /**
     * Create a new ZuoraService instance.
     *
     * @param string $accessToken Zuora OAuth 2.0 Bearer access token
     * @param string $baseUrl     Zuora REST API base URL (default: https://rest.zuora.com/v2)
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://rest.zuora.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List accounts with optional filtering and pagination.
     *
     * @param  int         $pageSize Number of results per page (default: 20, max: 100)
     * @param  string|null $cursor   Cursor for pagination from a previous response
     * @param  array       $filters  Additional query filters (e.g., ['name' => 'Acme'])
     * @return array       Zuora API response containing accounts
     */
    public function listAccounts(int $pageSize = 20, ?string $cursor = null, array $filters = []): array
    {
        $params = array_merge(['page_size' => $pageSize], $filters);
        if ($cursor) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/accounts', $params);
    }

    /**
     * Get a single account by its Zuora account ID.
     *
     * @param  string $accountId The Zuora account identifier
     * @return array  Zuora API response containing the account details
     */
    public function getAccount(string $accountId): array
    {
        return $this->request('GET', '/accounts/' . urlencode($accountId));
    }

    /**
     * List subscriptions with optional filtering and pagination.
     *
     * @param  int         $pageSize Number of results per page (default: 20, max: 100)
     * @param  string|null $cursor   Cursor for pagination from a previous response
     * @param  array       $filters  Additional query filters
     * @return array       Zuora API response containing subscriptions
     */
    public function listSubscriptions(int $pageSize = 20, ?string $cursor = null, array $filters = []): array
    {
        $params = array_merge(['page_size' => $pageSize], $filters);
        if ($cursor) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/subscriptions', $params);
    }

    /**
     * Get a single subscription by its Zuora subscription ID.
     *
     * @param  string $subscriptionId The Zuora subscription identifier
     * @return array  Zuora API response containing the subscription details
     */
    public function getSubscription(string $subscriptionId): array
    {
        return $this->request('GET', '/subscriptions/' . urlencode($subscriptionId));
    }

    /**
     * List invoices with optional filtering and pagination.
     *
     * @param  int         $pageSize Number of results per page (default: 20, max: 100)
     * @param  string|null $cursor   Cursor for pagination from a previous response
     * @param  array       $filters  Additional query filters
     * @return array       Zuora API response containing invoices
     */
    public function listInvoices(int $pageSize = 20, ?string $cursor = null, array $filters = []): array
    {
        $params = array_merge(['page_size' => $pageSize], $filters);
        if ($cursor) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/invoices', $params);
    }

    /**
     * List payments with optional filtering and pagination.
     *
     * @param  int         $pageSize Number of results per page (default: 20, max: 100)
     * @param  string|null $cursor   Cursor for pagination from a previous response
     * @param  array       $filters  Additional query filters
     * @return array       Zuora API response containing payments
     */
    public function listPayments(int $pageSize = 20, ?string $cursor = null, array $filters = []): array
    {
        $params = array_merge(['page_size' => $pageSize], $filters);
        if ($cursor) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/payments', $params);
    }

    /**
     * Get the currently authenticated Zuora user profile.
     *
     * @return array Zuora API response containing the current user details
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string $method HTTP method (GET, POST, PUT, DELETE)
     * @param  string $path   API endpoint path (relative to base URL)
     * @param  array  $data   Query parameters or request body
     * @return array  Parsed JSON response
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Zuora REST API.
     *
     * @param  string $method HTTP method (GET, POST, PUT, DELETE)
     * @param  string $path   API endpoint path (relative to base URL)
     * @param  array  $data   Query parameters or request body
     * @return \Illuminate\Http\Client\Response Raw HTTP response
     *
     * @throws \RuntimeException If the access token is not configured
     * @throws \RuntimeException If the API returns an error response
     * @throws \RuntimeException If the connection to Zuora fails
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Zuora access token is not configured.');
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
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();

                Log::error("Zuora API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Zuora API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zuora API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zuora API: {$e->getMessage()}");
        }
    }
}
