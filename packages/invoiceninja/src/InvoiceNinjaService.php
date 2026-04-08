<?php

namespace OpenCompany\Integrations\InvoiceNinja;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Invoice Ninja API service.
 *
 * Handles authenticated HTTP requests to the Invoice Ninja v1 REST API.
 * Supports configurable base URL for self-hosted instances.
 */
class InvoiceNinjaService
{
    /**
     * Create a new InvoiceNinjaService instance.
     *
     * @param  string  $apiToken  Bearer API token for authentication.
     * @param  string  $baseUrl   Base URL of the Invoice Ninja instance (e.g. "https://invoicing.yourdomain.com").
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://invoicing.yourdomain.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API token.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── Invoices ───────────────────────────────────────────

    /**
     * List invoices with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. per_page, page, client_id, status).
     * @return array<string, mixed>
     */
    public function listInvoices(array $params = []): array
    {
        return $this->request('GET', '/api/v1/invoices', $params);
    }

    /**
     * Get a single invoice by ID.
     *
     * @return array<string, mixed>
     */
    public function getInvoice(string $id): array
    {
        return $this->request('GET', '/api/v1/invoices/' . urlencode($id));
    }

    /**
     * Create a new invoice.
     *
     * @param  array<string, mixed>  $data  Invoice payload (client_id, line items, etc.).
     * @return array<string, mixed>
     */
    public function createInvoice(array $data): array
    {
        return $this->request('POST', '/api/v1/invoices', $data);
    }

    // ── Clients ────────────────────────────────────────────

    /**
     * List clients with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. per_page, page, search).
     * @return array<string, mixed>
     */
    public function listClients(array $params = []): array
    {
        return $this->request('GET', '/api/v1/clients', $params);
    }

    /**
     * Create a new client.
     *
     * @param  array<string, mixed>  $data  Client payload (name, contacts, etc.).
     * @return array<string, mixed>
     */
    public function createClient(array $data): array
    {
        return $this->request('POST', '/api/v1/clients', $data);
    }

    // ── Products ───────────────────────────────────────────

    /**
     * List products with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. per_page, page).
     * @return array<string, mixed>
     */
    public function listProducts(array $params = []): array
    {
        return $this->request('GET', '/api/v1/products', $params);
    }

    // ── Payments ───────────────────────────────────────────

    /**
     * List payments with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. per_page, page, client_id).
     * @return array<string, mixed>
     */
    public function listPayments(array $params = []): array
    {
        return $this->request('GET', '/api/v1/payments', $params);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/users/me');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Invoice Ninja API.
     *
     * @param  array<string, mixed>  $data
     *
     * @throws \RuntimeException  On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Invoice Ninja API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
                'X-Api-Token' => $this->apiToken,
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Invoice Ninja API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Invoice Ninja API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Invoice Ninja API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException('Invoice Ninja API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Invoice Ninja API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Invoice Ninja API: {$e->getMessage()}");
        }
    }
}
