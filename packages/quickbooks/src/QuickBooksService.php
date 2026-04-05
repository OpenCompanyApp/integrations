<?php

namespace OpenCompany\Integrations\QuickBooks;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * QuickBooks Online API service for making requests to the Intuit v3 REST API.
 *
 * Uses OAuth2 access tokens. All requests are JSON-based and target the
 * company-scoped endpoint: https://quickbooks.api.intuit.com/v3/company/{realmId}
 */
class QuickBooksService
{
    private const BASE_URL_TEMPLATE = 'https://quickbooks.api.intuit.com/v3/company/%s';

    /** @var string OAuth2 access token */
    private string $accessToken;

    /** @var string QuickBooks company (realm) ID from OAuth */
    private string $realmId;

    /** @var string Fully-qualified base URL including the realm ID */
    private string $baseUrl;

    /**
     * @param  string  $accessToken  OAuth2 access token for QuickBooks API
     * @param  string  $realmId      Company ID (realm ID) obtained during OAuth flow
     */
    public function __construct(string $accessToken = '', string $realmId = '')
    {
        $this->accessToken = $accessToken;
        $this->realmId = $realmId;
        $this->baseUrl = sprintf(self::BASE_URL_TEMPLATE, $realmId);
    }

    /**
     * Check whether the service has been configured with credentials.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken) && ! empty($this->realmId);
    }

    // ── Company Info ───────────────────────────────────────

    /**
     * Get company information for the connected realm.
     *
     * @return array<string, mixed>
     */
    public function getCompanyInfo(): array
    {
        return $this->request('GET', "/companyinfo/{$this->realmId}");
    }

    // ── Invoices ───────────────────────────────────────────

    /**
     * Create a new invoice.
     *
     * @param  array<string, mixed>  $data  Invoice payload
     * @return array<string, mixed>
     */
    public function createInvoice(array $data): array
    {
        return $this->request('POST', '/invoice', $data);
    }

    /**
     * Get an invoice by ID.
     *
     * @param  string  $id  QuickBooks invoice ID
     * @return array<string, mixed>
     */
    public function getInvoice(string $id): array
    {
        return $this->request('GET', "/invoice/{$id}");
    }

    /**
     * Update an existing invoice (full update with syncToken).
     *
     * @param  array<string, mixed>  $data  Invoice payload including Id and syncToken
     * @return array<string, mixed>
     */
    public function updateInvoice(array $data): array
    {
        return $this->request('POST', '/invoice?operation=update', $data);
    }

    /**
     * Run a query against the QuickBooks query API.
     *
     * @param  string  $query  SQL-like query string (e.g., "SELECT * FROM Invoice")
     * @return array<string, mixed>
     */
    public function query(string $query): array
    {
        return $this->request('GET', '/query', ['query' => $query]);
    }

    // ── Customers ──────────────────────────────────────────

    /**
     * Create a new customer.
     *
     * @param  array<string, mixed>  $data  Customer payload
     * @return array<string, mixed>
     */
    public function createCustomer(array $data): array
    {
        return $this->request('POST', '/customer', $data);
    }

    /**
     * Get a customer by ID.
     *
     * @param  string  $id  QuickBooks customer ID
     * @return array<string, mixed>
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', "/customer/{$id}");
    }

    /**
     * Update an existing customer (full update with syncToken).
     *
     * @param  array<string, mixed>  $data  Customer payload including Id and syncToken
     * @return array<string, mixed>
     */
    public function updateCustomer(array $data): array
    {
        return $this->request('POST', '/customer?operation=update', $data);
    }

    // ── Payments ───────────────────────────────────────────

    /**
     * Create a new payment.
     *
     * @param  array<string, mixed>  $data  Payment payload
     * @return array<string, mixed>
     */
    public function createPayment(array $data): array
    {
        return $this->request('POST', '/payment', $data);
    }

    // ── Estimates ──────────────────────────────────────────

    /**
     * Create a new estimate.
     *
     * @param  array<string, mixed>  $data  Estimate payload
     * @return array<string, mixed>
     */
    public function createEstimate(array $data): array
    {
        return $this->request('POST', '/estimate', $data);
    }

    // ── Bills ──────────────────────────────────────────────

    /**
     * Create a new bill.
     *
     * @param  array<string, mixed>  $data  Bill payload
     * @return array<string, mixed>
     */
    public function createBill(array $data): array
    {
        return $this->request('POST', '/bill', $data);
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to QuickBooks Online.
     *
     * @param  string  $method  HTTP method (GET or POST)
     * @param  string  $path    API path (relative to base URL)
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('QuickBooks integration is not configured. Access token and realm ID are required.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->accessToken}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $url = $this->baseUrl . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $json = $response->json() ?? [];

            if (! $response->successful()) {
                $fault = $json['Fault'] ?? null;
                if ($fault) {
                    $errorMessages = array_map(
                        fn (array $e) => ($e['Message'] ?? 'Unknown error') . (isset($e['code']) ? " (code: {$e['code']})" : ''),
                        $fault['Error'] ?? []
                    );
                    $error = implode('; ', $errorMessages);
                } else {
                    $error = $response->body();
                }

                Log::error("QuickBooks API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException('QuickBooks API error (' . $response->status() . '): ' . $error);
            }

            return $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("QuickBooks API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to QuickBooks API: {$e->getMessage()}");
        }
    }
}
