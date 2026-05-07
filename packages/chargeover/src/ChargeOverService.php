<?php

namespace OpenCompany\Integrations\ChargeOver;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the ChargeOver REST API v3.
 *
 * Handles host URL normalization, Basic authentication, request dispatch,
 * error parsing, and lightweight response shaping for ChargeOver tools.
 */
class ChargeOverService
{
    /**
     * Create a new ChargeOver API service.
     *
     * @param  string  $apiUsername  ChargeOver API username or key used as the Basic Auth username.
     * @param  string  $apiPassword  ChargeOver API password or secret used as the Basic Auth password.
     * @param  string  $subdomain    ChargeOver subdomain used to build https://{subdomain}.chargeover.com.
     * @param  string  $baseUrl      Optional ChargeOver instance URL override.
     * @param  string  $accessToken  Legacy bearer-token field; treated as the API username when apiUsername is empty.
     */
    public function __construct(
        private string $apiUsername = '',
        private string $apiPassword = '',
        private string $subdomain = '',
        private string $baseUrl = '',
        string $accessToken = '',
    ) {
        if ($this->apiUsername === '' && $accessToken !== '') {
            $this->apiUsername = $accessToken;
        }

        if ($this->baseUrl === '' && $this->subdomain !== '') {
            $this->baseUrl = 'https://' . $this->subdomain . '.chargeover.com';
        }

        $this->baseUrl = preg_replace('#/api/v3/?$#', '', rtrim($this->baseUrl, '/')) ?? '';
    }

    /**
     * Determine whether the service has enough credentials for API calls.
     */
    public function isConfigured(): bool
    {
        return $this->apiUsername !== '' && $this->apiPassword !== '' && $this->baseUrl !== '';
    }

    /**
     * Return the normalized ChargeOver instance URL without the /api/v3 suffix.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Verify credentials with a lightweight customer list request.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v3/customer', ['limit' => 1, 'offset' => 0]);
    }

    /**
     * List customers.
     *
     * @param  int  $limit  Number of records to return.
     * @param  int  $offset  Record offset for pagination.
     * @param  string|null  $where  ChargeOver query expression such as customer.status:EQUALS:active.
     * @param  string|null  $order  ChargeOver sort expression such as customer_id:DESC.
     * @param  string|null  $expand  Optional expand value from the ChargeOver API.
     * @return array<string, mixed>
     */
    public function listCustomers(int $limit = 10, int $offset = 0, ?string $where = null, ?string $order = null, ?string $expand = null): array
    {
        return $this->request('GET', '/api/v3/customer', $this->listParams($limit, $offset, $where, $order, $expand));
    }

    /**
     * Get a single customer by ChargeOver customer_id.
     *
     * @param  int  $id  ChargeOver customer_id.
     * @return array<string, mixed>
     */
    public function getCustomer(int $id): array
    {
        return $this->request('GET', '/api/v3/customer/' . $id);
    }

    /**
     * List ChargeOver packages/subscriptions.
     *
     * ChargeOver's API resource for subscription-like package records is /package.
     *
     * @param  int  $limit  Number of records to return.
     * @param  int  $offset  Record offset for pagination.
     * @param  int|null  $customerId  Optional customer_id filter.
     * @param  string|null  $where  Optional ChargeOver query expression.
     * @param  string|null  $order  Optional ChargeOver sort expression.
     * @param  string|null  $expand  Optional expand value from the ChargeOver API.
     * @return array<string, mixed>
     */
    public function listSubscriptions(int $limit = 10, int $offset = 0, ?int $customerId = null, ?string $where = null, ?string $order = null, ?string $expand = null): array
    {
        if ($customerId !== null) {
            $customerWhere = 'customer_id:EQUALS:' . $customerId;
            $where = $where !== null && $where !== '' ? $where . ',' . $customerWhere : $customerWhere;
        }

        return $this->request('GET', '/api/v3/package', $this->listParams($limit, $offset, $where, $order, $expand));
    }

    /**
     * List invoices.
     *
     * @param  int  $limit  Number of records to return.
     * @param  int  $offset  Record offset for pagination.
     * @param  string|null  $where  ChargeOver query expression such as invoice.status:EQUALS:open.
     * @param  string|null  $order  ChargeOver sort expression such as invoice_id:DESC.
     * @param  string|null  $expand  Optional expand value from the ChargeOver API.
     * @return array<string, mixed>
     */
    public function listInvoices(int $limit = 10, int $offset = 0, ?string $where = null, ?string $order = null, ?string $expand = null): array
    {
        return $this->request('GET', '/api/v3/invoice', $this->listParams($limit, $offset, $where, $order, $expand));
    }

    /**
     * Get a single invoice by ChargeOver invoice_id.
     *
     * @param  int  $id  ChargeOver invoice_id.
     * @return array<string, mixed>
     */
    public function getInvoice(int $id): array
    {
        return $this->request('GET', '/api/v3/invoice/' . $id);
    }

    /**
     * List transactions.
     *
     * @param  int  $limit  Number of records to return.
     * @param  int  $offset  Record offset for pagination.
     * @param  string|null  $where  ChargeOver query expression such as transaction.void:EQUALS:0.
     * @param  string|null  $order  ChargeOver sort expression such as transaction_id:DESC.
     * @param  string|null  $expand  Optional expand value from the ChargeOver API.
     * @return array<string, mixed>
     */
    public function listTransactions(int $limit = 10, int $offset = 0, ?string $where = null, ?string $order = null, ?string $expand = null): array
    {
        return $this->request('GET', '/api/v3/transaction', $this->listParams($limit, $offset, $where, $order, $expand));
    }

    /**
     * Get a single transaction by ChargeOver transaction_id.
     *
     * @param  int  $id  ChargeOver transaction_id.
     * @return array<string, mixed>
     */
    public function getTransaction(int $id): array
    {
        return $this->request('GET', '/api/v3/transaction/' . $id);
    }

    /**
     * Build documented ChargeOver list-query parameters.
     *
     * @param  int  $limit
     * @param  int  $offset
     * @param  string|null  $where
     * @param  string|null  $order
     * @param  string|null  $expand
     * @return array<string, mixed>
     */
    private function listParams(int $limit, int $offset, ?string $where, ?string $order, ?string $expand): array
    {
        $params = [
            'limit' => max(1, min($limit, 500)),
            'offset' => max(0, $offset),
        ];

        foreach (['where' => $where, 'order' => $order, 'expand' => $expand] as $key => $value) {
            if ($value !== null && $value !== '') {
                $params[$key] = $value;
            }
        }

        return $params;
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path, including /api/v3.
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
     * Make a raw HTTP request to the ChargeOver API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if ($this->apiUsername === '' || $this->apiPassword === '') {
            throw new RuntimeException('ChargeOver API username and password are not configured.');
        }

        if ($this->baseUrl === '') {
            throw new RuntimeException('ChargeOver base URL is not configured. Provide a subdomain or custom URL.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::acceptJson()
                ->asJson()
                ->withBasicAuth($this->apiUsername, $this->apiPassword)
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("ChargeOver API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);

                    throw new RuntimeException("ChargeOver API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('message')
                    ?? $response->json('error')
                    ?? $response->json('response.message')
                    ?? $body;

                Log::error("ChargeOver API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('ChargeOver API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("ChargeOver API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to ChargeOver API: {$e->getMessage()}");
        }
    }
}
