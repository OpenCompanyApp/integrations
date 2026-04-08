<?php

namespace OpenCompany\Integrations\ZohoBills;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZohoBillsService
{
    public function __construct(
        private string $accessToken = '',
        private string $organizationId = '',
        private string $baseUrl = 'https://billing.zoho.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->organizationId);
    }

    /**
     * List invoices with optional filters.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @param  string|null  $status  Filter by status: draft, sent, overdue, paid, voided, partially_paid.
     * @param  string|null  $customerId  Filter by customer ID.
     * @return array<string, mixed>
     */
    public function listInvoices(int $page = 1, int $perPage = 25, ?string $status = null, ?string $customerId = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        if ($customerId !== null) {
            $params['customer_id'] = $customerId;
        }

        return $this->request('GET', '/api/v3/invoices', $params);
    }

    /**
     * Get a single invoice by ID.
     *
     * @param  string  $id  The invoice ID.
     * @return array<string, mixed>
     */
    public function getInvoice(string $id): array
    {
        return $this->request('GET', '/api/v3/invoices/' . urlencode($id));
    }

    /**
     * Create a new invoice.
     *
     * @param  string  $customerId  The customer ID to bill.
     * @param  array<int, array<string, mixed>>  $lineItems  Array of line items (each with item_id or name, rate, quantity, etc.).
     * @param  string|null  $date  Invoice date (YYYY-MM-DD). Defaults to today.
     * @param  string|null  $dueDate  Due date (YYYY-MM-DD).
     * @param  array<string, mixed>  $extra  Additional invoice fields.
     * @return array<string, mixed>
     */
    public function createInvoice(string $customerId, array $lineItems, ?string $date = null, ?string $dueDate = null, array $extra = []): array
    {
        $data = array_merge($extra, [
            'customer_id' => $customerId,
            'line_items' => $lineItems,
        ]);

        if ($date !== null) {
            $data['date'] = $date;
        }

        if ($dueDate !== null) {
            $data['due_date'] = $dueDate;
        }

        return $this->request('POST', '/api/v3/invoices', $data);
    }

    /**
     * List customers (contacts) with optional filters.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @param  string|null  $type  Filter by type: customer, vendor.
     * @return array<string, mixed>
     */
    public function listCustomers(int $page = 1, int $perPage = 25, ?string $type = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/api/v3/contacts', $params);
    }

    /**
     * Get a single customer (contact) by ID.
     *
     * @param  string  $id  The contact ID.
     * @return array<string, mixed>
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', '/api/v3/contacts/' . urlencode($id));
    }

    /**
     * List items (products/services).
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @return array<string, mixed>
     */
    public function listItems(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/api/v3/items', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v3/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Zoho Bills API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params or body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Zoho Bills access token is not configured.');
        }

        if (!$this->organizationId) {
            throw new \RuntimeException('Zoho Bills organization ID is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'X-com-zoho-bills-organizationid' => $this->organizationId,
            ])->timeout(30);

            // Always include organization_id as a query parameter for safety
            if (strtoupper($method) === 'GET') {
                $data['organization_id'] = $this->organizationId;
            }

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, array_merge($data, ['organization_id' => $this->organizationId])),
                'PUT' => $http->put($url, array_merge($data, ['organization_id' => $this->organizationId])),
                'DELETE' => $http->delete($url, array_merge($data, ['organization_id' => $this->organizationId])),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Zoho Bills API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Zoho Bills API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $json = $response->json();
                $error = $json['message'] ?? $json['error'] ?? $body;
                Log::error("Zoho Bills API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Zoho Bills API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoho Bills API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zoho Bills API: {$e->getMessage()}");
        }
    }
}
