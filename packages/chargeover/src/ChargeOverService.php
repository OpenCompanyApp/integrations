<?php

namespace OpenCompany\Integrations\ChargeOver;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChargeOverService
{
    public function __construct(
        private string $accessToken = '',
        private string $subdomain = '',
        private string $baseUrl = '',
    ) {
        // Allow a fully custom base URL, or construct from subdomain
        if (empty($this->baseUrl) && !empty($this->subdomain)) {
            $this->baseUrl = 'https://' . $this->subdomain . '.chargeover.com';
        }
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->baseUrl);
    }

    /**
     * List customers.
     *
     * @param  int  $limit   Number of results per page (max 500, default 10).
     * @param  int  $page    Page number (1-based).
     * @param  string|null  $status  Filter by status (e.g. "active", "inactive", "cancelled").
     * @return array<string, mixed>
     */
    public function listCustomers(int $limit = 10, int $page = 1, ?string $status = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/api/v3/customer', $params);
    }

    /**
     * Get a single customer by ID.
     *
     * @param  int  $id  The customer ID.
     * @return array<string, mixed>
     */
    public function getCustomer(int $id): array
    {
        return $this->request('GET', '/api/v3/customer/' . $id);
    }

    /**
     * List subscriptions.
     *
     * @param  int  $limit        Number of results per page (max 500, default 10).
     * @param  int  $page         Page number (1-based).
     * @param  int|null  $customerId  Filter by customer ID.
     * @return array<string, mixed>
     */
    public function listSubscriptions(int $limit = 10, int $page = 1, ?int $customerId = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];
        if ($customerId !== null) {
            $params['customer_id'] = $customerId;
        }

        return $this->request('GET', '/api/v3/subscribe', $params);
    }

    /**
     * List invoices.
     *
     * @param  int  $limit   Number of results per page (max 500, default 10).
     * @param  int  $page    Page number (1-based).
     * @param  string|null  $status  Filter by status (e.g. "open", "paid", "overdue", "cancelled").
     * @return array<string, mixed>
     */
    public function listInvoices(int $limit = 10, int $page = 1, ?string $status = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/api/v3/invoice', $params);
    }

    /**
     * Get a single invoice by ID.
     *
     * @param  int  $id  The invoice ID.
     * @return array<string, mixed>
     */
    public function getInvoice(int $id): array
    {
        return $this->request('GET', '/api/v3/invoice/' . $id);
    }

    /**
     * List transactions (payments).
     *
     * @param  int  $limit  Number of results per page (max 500, default 10).
     * @param  int  $page   Page number (1-based).
     * @return array<string, mixed>
     */
    public function listTransactions(int $limit = 10, int $page = 1): array
    {
        return $this->request('GET', '/api/v3/transaction', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get the current authenticated user / account info.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v3/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. "/api/v3/customer").
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
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('ChargeOver access token is not configured.');
        }

        if (!$this->baseUrl) {
            throw new \RuntimeException('ChargeOver base URL is not configured. Provide a subdomain or custom URL.');
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("ChargeOver API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("ChargeOver API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("ChargeOver API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("ChargeOver API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ChargeOver API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ChargeOver API: {$e->getMessage()}");
        }
    }
}
