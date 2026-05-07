<?php

namespace OpenCompany\Integrations\Mollie;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Mollie REST API.
 *
 * Handles Bearer-token authentication and request execution for payments,
 * customers, subscriptions, invoices, and payment methods.
 */
class MollieService
{
    /**
     * Create a new Mollie service instance.
     *
     * @param  string  $accessToken  The Mollie API access token.
     * @param  string  $baseUrl  The Mollie API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.mollie.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List payments with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, from, profileId, etc.).
     * @return array<string, mixed> The parsed JSON response containing a `_embedded.payments` list.
     */
    public function listPayments(array $params = []): array
    {
        return $this->request('GET', '/payments', $params);
    }

    /**
     * Retrieve a single payment by its ID.
     *
     * @param  string  $id  The payment ID (e.g., "tr_abc123").
     * @return array<string, mixed> The payment resource.
     */
    public function getPayment(string $id): array
    {
        return $this->request('GET', '/payments/' . urlencode($id));
    }

    /**
     * Create a new payment.
     *
     * @param  array<string, mixed>  $data  Payment data including amount, description, redirectUrl, etc.
     * @return array<string, mixed> The created payment resource.
     */
    public function createPayment(array $data): array
    {
        return $this->request('POST', '/payments', $data);
    }

    /**
     * List customers with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, from, etc.).
     * @return array<string, mixed> The parsed JSON response containing a `_embedded.customers` list.
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    /**
     * Create a new customer.
     *
     * @param  array<string, mixed>  $data  Customer data including name, email, etc.
     * @return array<string, mixed> The created customer resource.
     */
    public function createCustomer(array $data): array
    {
        return $this->request('POST', '/customers', $data);
    }

    /**
     * List subscriptions for a specific customer.
     *
     * @param  string  $customerId  The customer ID (e.g., "cst_abc123").
     * @param  array<string, mixed>  $params  Query parameters (limit, from, etc.).
     * @return array<string, mixed> The parsed JSON response containing a `_embedded.subscriptions` list.
     */
    public function listSubscriptions(string $customerId, array $params = []): array
    {
        return $this->request('GET', '/customers/' . urlencode($customerId) . '/subscriptions', $params);
    }

    /**
     * Create a subscription for a customer.
     *
     * @param  string  $customerId  The customer ID (e.g., "cst_abc123").
     * @param  array<string, mixed>  $data  Subscription data including amount, interval, description, etc.
     * @return array<string, mixed> The created subscription resource.
     */
    public function createSubscription(string $customerId, array $data): array
    {
        return $this->request('POST', '/customers/' . urlencode($customerId) . '/subscriptions', $data);
    }

    /**
     * List invoices for the authenticated account.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, from, reference, year, month, etc.).
     * @return array<string, mixed> The parsed JSON response containing a `_embedded.invoices` list.
     */
    public function listInvoices(array $params = []): array
    {
        return $this->request('GET', '/invoices', $params);
    }

    /**
     * Retrieve the enabled payment methods for the authenticated account.
     *
     * Maps to GET /methods which returns the list of available payment methods.
     *
     * @return array<string, mixed> The parsed JSON response containing a `_embedded.methods` list.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/methods');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> The parsed JSON response body.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Mollie API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Mollie access token is not configured.');
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
                $json = $response->json();
                $error = $json['detail'] ?? $json['title'] ?? $response->body();

                Log::error("Mollie API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Mollie API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mollie API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mollie API: {$e->getMessage()}");
        }
    }
}
