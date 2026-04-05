<?php

namespace OpenCompany\Integrations\ZohoInvoice;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for the Zoho Invoice API.
 *
 * Handles all HTTP communication with the Zoho Invoice REST API v3.
 * Tools call service methods — they never make HTTP requests directly.
 */
class ZohoInvoiceService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://invoice.zoho.com/api/v3',
        private string $organizationId = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    // ── Invoices ──────────────────────────────────────────

    /**
     * List invoices with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (status, customer_id, date, etc.)
     * @return array<string, mixed>
     */
    public function listInvoices(array $params = []): array
    {
        return $this->request('GET', '/invoices', $params);
    }

    /**
     * Get a single invoice by ID.
     *
     * @return array<string, mixed>
     */
    public function getInvoice(string $invoiceId): array
    {
        return $this->request('GET', '/invoices/' . urlencode($invoiceId));
    }

    /**
     * Create a new invoice.
     *
     * @param  array<string, mixed>  $data  Invoice payload (customer_id, line_items, etc.)
     * @return array<string, mixed>
     */
    public function createInvoice(array $data): array
    {
        return $this->request('POST', '/invoices', $data);
    }

    // ── Contacts ──────────────────────────────────────────

    /**
     * List contacts (customers and vendors).
     *
     * @param  array<string, mixed>  $params  Query parameters (type, status, etc.)
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    // ── Items ─────────────────────────────────────────────

    /**
     * List items (products and services).
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listItems(array $params = []): array
    {
        return $this->request('GET', '/items', $params);
    }

    // ── Payments ──────────────────────────────────────────

    /**
     * List payments received.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listPayments(array $params = []): array
    {
        return $this->request('GET', '/payments', $params);
    }

    // ── Users ─────────────────────────────────────────────

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── HTTP ──────────────────────────────────────────────

    /**
     * Make an authenticated API request to Zoho Invoice.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API endpoint path (e.g. "/invoices")
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PUT)
     * @return array<string, mixed>
     *
     * @throws \RuntimeException on connection or API errors
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Zoho Invoice access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            if ($this->organizationId) {
                $http = $http->withQueryParameters([
                    'organization_id' => $this->organizationId,
                ]);
            }

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();
                Log::error("Zoho Invoice API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException(
                    'Zoho Invoice API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoho Invoice API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zoho Invoice API: {$e->getMessage()}");
        }
    }
}
