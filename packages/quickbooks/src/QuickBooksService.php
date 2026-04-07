<?php

namespace OpenCompany\Integrations\QuickBooks;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuickBooksService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.quickbooks.com/v3',
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

    // ─── Invoices ──────────────────────────────────────────────────────────

    /**
     * List invoices using a query.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, etc.)
     * @return array<string, mixed>
     */
    public function listInvoices(array $params = []): array
    {
        $limit = isset($params['limit']) ? (int) $params['limit'] : 10;
        $query = "SELECT * FROM Invoice STARTPOSITION 0 MAXRESULTS {$limit}";

        return $this->request('GET', '/query', ['query' => $query]);
    }

    /**
     * Get a single invoice by ID.
     *
     * @return array<string, mixed>
     */
    public function getInvoice(string $invoiceId): array
    {
        return $this->request('GET', "/invoice/{$invoiceId}");
    }

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

    // ─── Customers ─────────────────────────────────────────────────────────

    /**
     * List customers using a query.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, etc.)
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        $limit = isset($params['limit']) ? (int) $params['limit'] : 10;
        $query = "SELECT * FROM Customer STARTPOSITION 0 MAXRESULTS {$limit}";

        return $this->request('GET', '/query', ['query' => $query]);
    }

    /**
     * Get a single customer by ID.
     *
     * @return array<string, mixed>
     */
    public function getCustomer(string $customerId): array
    {
        return $this->request('GET', "/customer/{$customerId}");
    }

    // ─── Accounts ──────────────────────────────────────────────────────────

    /**
     * List accounts using a query.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, etc.)
     * @return array<string, mixed>
     */
    public function listAccounts(array $params = []): array
    {
        $limit = isset($params['limit']) ? (int) $params['limit'] : 10;
        $query = "SELECT * FROM Account STARTPOSITION 0 MAXRESULTS {$limit}";

        return $this->request('GET', '/query', ['query' => $query]);
    }

    // ─── Current User ──────────────────────────────────────────────────────

    /**
     * Get the currently authenticated user / company info.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/companyinfo/current');
    }

    // ─── HTTP Layer ────────────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON data.
     *
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PUT)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the QuickBooks API.
     *
     * @param  array<string, mixed>  $data
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('QuickBooks integration is not configured. Access token is required.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $json = $response->json() ?? [];
                $fault = $json['Fault'] ?? null;
                if ($fault) {
                    $errorMessages = array_map(
                        fn(array $e) => ($e['Message'] ?? 'Unknown error') . (isset($e['code']) ? " (code: {$e['code']})" : ''),
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

                throw new \RuntimeException("QuickBooks API error ({$response->status()}): {$error}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("QuickBooks API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to QuickBooks API: {$e->getMessage()}");
        }
    }
}
