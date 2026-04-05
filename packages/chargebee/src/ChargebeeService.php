<?php

namespace OpenCompany\Integrations\Chargebee;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Chargebee API service for managing subscriptions, customers, invoices, and plans.
 *
 * Communicates with the Chargebee REST API v2 using HTTP Basic Authentication.
 * Supports multi-account configuration via constructor injection.
 */
class ChargebeeService
{
    /**
     * Create a new ChargebeeService instance.
     *
     * @param  string  $apiKey   Chargebee API key (used as Basic Auth username).
     * @param  string  $siteName Chargebee site name (subdomain).
     */
    public function __construct(
        private string $apiKey = '',
        private string $siteName = '',
    ) {}

    /**
     * Check whether the service is properly configured with an API key and site name.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->siteName);
    }

    /**
     * Get the base URL for the Chargebee API.
     */
    public function getBaseUrl(): string
    {
        return "https://{$this->siteName}.chargebee.com/api/v2";
    }

    /**
     * Verify site access by retrieving site information.
     *
     * @return array<string, mixed>
     */
    public function getSite(): array
    {
        return $this->request('GET', '/site');
    }

    /**
     * List subscriptions with optional filtering.
     *
     * @param  int|null     $limit   Number of results per page (max 100).
     * @param  string|null  $offset  Pagination offset from previous response.
     * @param  string|null  $status  Filter by status: active, cancelled, non_renewing, paused, etc.
     * @param  string|null  $planId  Filter by plan ID.
     * @return array<string, mixed>
     */
    public function listSubscriptions(?int $limit = null, ?string $offset = null, ?string $status = null, ?string $planId = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }
        if ($status !== null) {
            $params['status[is]'] = $status;
        }
        if ($planId !== null) {
            $params['plan_id[is]'] = $planId;
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
     * Create a new subscription.
     *
     * @param  array<string, mixed>  $params  Subscription creation parameters.
     * @return array<string, mixed>
     */
    public function createSubscription(array $params): array
    {
        return $this->request('POST', '/subscriptions', $params);
    }

    /**
     * Update an existing subscription.
     *
     * @param  string                  $id      The subscription ID.
     * @param  array<string, mixed>    $params  Update parameters (plan_id, addons, etc.).
     * @return array<string, mixed>
     */
    public function updateSubscription(string $id, array $params): array
    {
        return $this->request('POST', '/subscriptions/' . urlencode($id), $params);
    }

    /**
     * Cancel a subscription.
     *
     * @param  string  $id  The subscription ID.
     * @return array<string, mixed>
     */
    public function cancelSubscription(string $id): array
    {
        return $this->request('POST', '/subscriptions/' . urlencode($id) . '/cancel');
    }

    /**
     * List customers with optional filtering.
     *
     * @param  int|null      $limit   Number of results per page (max 100).
     * @param  string|null   $offset  Pagination offset from previous response.
     * @return array<string, mixed>
     */
    public function listCustomers(?int $limit = null, ?string $offset = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
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
     * Create a new customer.
     *
     * @param  array<string, mixed>  $params  Customer creation parameters.
     * @return array<string, mixed>
     */
    public function createCustomer(array $params): array
    {
        return $this->request('POST', '/customers', $params);
    }

    /**
     * List invoices with optional filtering.
     *
     * @param  int|null      $limit       Number of results per page (max 100).
     * @param  string|null   $offset      Pagination offset from previous response.
     * @param  string|null   $status      Filter by status: paid, posted, payment_due, etc.
     * @param  string|null   $dateAfter   Filter invoices after this date (Unix timestamp or YYYY-MM-DD).
     * @param  string|null   $dateBefore  Filter invoices before this date (Unix timestamp or YYYY-MM-DD).
     * @return array<string, mixed>
     */
    public function listInvoices(?int $limit = null, ?string $offset = null, ?string $status = null, ?string $dateAfter = null, ?string $dateBefore = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }
        if ($status !== null) {
            $params['status[is]'] = $status;
        }
        if ($dateAfter !== null) {
            $params['date[after]'] = $dateAfter;
        }
        if ($dateBefore !== null) {
            $params['date[before]'] = $dateBefore;
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
     * List available plans.
     *
     * @param  int|null  $limit  Number of results per page (max 100).
     * @return array<string, mixed>
     */
    public function listPlans(?int $limit = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        return $this->request('GET', '/plans', $params);
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
     * Uses HTTP Basic Authentication with the API key as the username and an empty password.
     *
     * @param  string               $method  HTTP method.
     * @param  string               $path    API endpoint path.
     * @param  array<string, mixed> $data    Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key or site name is missing, or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->siteName) {
            throw new \RuntimeException('Chargebee API key and site name are not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, '')
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asForm()->post($url, $data),
                'PUT' => $http->asForm()->put($url, $data),
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
