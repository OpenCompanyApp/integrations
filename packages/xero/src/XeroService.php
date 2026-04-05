<?php

namespace OpenCompany\Integrations\Xero;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Xero API service for making requests to the Xero Accounting REST API.
 *
 * Uses OAuth2 Bearer token authentication with a required Xero-Tenant-Id header.
 * Xero uses PUT for create (upsert) operations and POST for updates.
 * Responses wrap resources in plural keys like {"Invoices": [...]}.
 */
class XeroService
{
    private const BASE_URL = 'https://api.xero.com/api.xro/2.0';

    /**
     * @param  string  $accessToken  OAuth2 access token for Xero API
     * @param  string  $tenantId     Xero tenant ID (required header for all requests)
     */
    public function __construct(
        private string $accessToken = '',
        private string $tenantId = '',
    ) {}

    /**
     * Check whether the Xero service is configured with credentials.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken) && ! empty($this->tenantId);
    }

    // ── Invoices ───────────────────────────────────────────

    /**
     * Create (upsert) an invoice in Xero.
     *
     * @param  array<string, mixed>  $data  Invoice payload wrapped in {"Invoices": [{...}]}
     * @return array<string, mixed>
     */
    public function createInvoice(array $data): array
    {
        return $this->request('PUT', '/Invoices', $data);
    }

    /**
     * Get a single invoice by ID.
     *
     * @param  string  $id  Xero invoice GUID
     * @return array<string, mixed>
     */
    public function getInvoice(string $id): array
    {
        return $this->request('GET', "/Invoices/{$id}");
    }

    /**
     * List invoices with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (Status, ContactID, etc.)
     * @return array<string, mixed>
     */
    public function listInvoices(array $params = []): array
    {
        return $this->request('GET', '/Invoices', $params);
    }

    /**
     * Update an existing invoice.
     *
     * @param  string  $id  Xero invoice GUID
     * @param  array<string, mixed>  $data  Invoice fields to update
     * @return array<string, mixed>
     */
    public function updateInvoice(string $id, array $data): array
    {
        return $this->request('POST', "/Invoices/{$id}", $data);
    }

    // ── Contacts ───────────────────────────────────────────

    /**
     * Create (upsert) a contact in Xero.
     *
     * @param  array<string, mixed>  $data  Contact payload wrapped in {"Contacts": [{...}]}
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('PUT', '/Contacts', $data);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $id  Xero contact GUID
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', "/Contacts/{$id}");
    }

    /**
     * List contacts with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/Contacts', $params);
    }

    /**
     * Update an existing contact.
     *
     * @param  string  $id  Xero contact GUID
     * @param  array<string, mixed>  $data  Contact fields to update
     * @return array<string, mixed>
     */
    public function updateContact(string $id, array $data): array
    {
        return $this->request('POST', "/Contacts/{$id}", $data);
    }

    // ── Payments ───────────────────────────────────────────

    /**
     * Create a payment in Xero.
     *
     * @param  array<string, mixed>  $data  Payment payload wrapped in {"Payments": [{...}]}
     * @return array<string, mixed>
     */
    public function createPayment(array $data): array
    {
        return $this->request('PUT', '/Payments', $data);
    }

    /**
     * List payments with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listPayments(array $params = []): array
    {
        return $this->request('GET', '/Payments', $params);
    }

    // ── Accounts ───────────────────────────────────────────

    /**
     * List chart of accounts with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listAccounts(array $params = []): array
    {
        return $this->request('GET', '/Accounts', $params);
    }

    // ── Bank Transactions ──────────────────────────────────

    /**
     * Create (upsert) a bank transaction in Xero.
     *
     * @param  array<string, mixed>  $data  Bank transaction payload
     * @return array<string, mixed>
     */
    public function createBankTransaction(array $data): array
    {
        return $this->request('PUT', '/BankTransactions', $data);
    }

    /**
     * List bank transactions with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listBankTransactions(array $params = []): array
    {
        return $this->request('GET', '/BankTransactions', $params);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * List users in the Xero organisation.
     *
     * @return array<string, mixed>
     */
    public function listUsers(): array
    {
        return $this->request('GET', '/Users');
    }

    // ── Organisations ──────────────────────────────────────

    /**
     * List organisations connected to the Xero tenant.
     *
     * @return array<string, mixed>
     */
    public function listOrganisations(): array
    {
        return $this->request('GET', '/Organisations');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to Xero.
     *
     * @param  string  $method  HTTP method (GET, PUT, POST)
     * @param  string  $path    API endpoint path (e.g. /Invoices)
     * @param  array<string, mixed>  $data  Request body (for PUT/POST) or query params (for GET)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Xero access token is not configured.');
        }

        if (! $this->tenantId) {
            throw new \RuntimeException('Xero tenant ID is not configured.');
        }

        try {
            $http = Http::withToken($this->accessToken)
                ->withHeaders([
                    'Xero-Tenant-Id' => $this->tenantId,
                    'Accept' => 'application/json',
                ])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get(self::BASE_URL . $path, $data),
                'PUT' => $http->put(self::BASE_URL . $path, $data),
                'POST' => $http->post(self::BASE_URL . $path, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $json = $response->json() ?? [];

            if (! $response->successful()) {
                $error = $json['Message'] ?? $json['Title'] ?? $response->body();

                Log::error("Xero API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                $msg = is_string($error) ? $error : json_encode($error);

                throw new \RuntimeException('Xero API error (' . $response->status() . '): ' . $msg);
            }

            return $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Xero API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Xero API: {$e->getMessage()}");
        }
    }
}
