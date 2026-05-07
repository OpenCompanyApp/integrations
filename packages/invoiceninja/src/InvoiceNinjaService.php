<?php

namespace OpenCompany\Integrations\InvoiceNinja;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * Invoice Ninja API service.
 *
 * Handles authenticated HTTP requests to the Invoice Ninja v5 REST API.
 * Supports the hosted cloud API and configurable self-hosted instance URLs.
 */
class InvoiceNinjaService
{
    /**
     * Create a new InvoiceNinjaService instance.
     *
     * @param  string  $apiToken  Bearer API token for authentication.
     * @param  string  $baseUrl  Base URL of the Invoice Ninja instance.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://invoicing.co',
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

    // Invoices

    /**
     * List invoices with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. per_page, page, client_id, status).
     * @return array<string, mixed>
     */
    public function listInvoices(array $params = []): array
    {
        return $this->apiGet('/api/v1/invoices', $params);
    }

    /**
     * Get a single invoice by ID.
     *
     * @param  string  $id  Invoice hashed ID.
     *
     * @return array<string, mixed>
     */
    public function getInvoice(string $id): array
    {
        return $this->apiGet('/api/v1/invoices/' . rawurlencode($id));
    }

    /**
     * Create a new invoice.
     *
     * @param  array<string, mixed>  $data  Invoice payload (client_id, line items, etc.).
     * @return array<string, mixed>
     */
    public function createInvoice(array $data): array
    {
        return $this->apiPost('/api/v1/invoices', $data);
    }

    // Clients

    /**
     * List clients with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. per_page, page, search).
     * @return array<string, mixed>
     */
    public function listClients(array $params = []): array
    {
        return $this->apiGet('/api/v1/clients', $params);
    }

    /**
     * Get a single client by ID.
     *
     * @param  string  $id  Client hashed ID.
     * @return array<string, mixed>
     */
    public function getClient(string $id): array
    {
        return $this->apiGet('/api/v1/clients/' . rawurlencode($id));
    }

    /**
     * Create a new client.
     *
     * @param  array<string, mixed>  $data  Client payload (name, contacts, etc.).
     * @return array<string, mixed>
     */
    public function createClient(array $data): array
    {
        return $this->apiPost('/api/v1/clients', $data);
    }

    // Products

    /**
     * List products with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. per_page, page).
     * @return array<string, mixed>
     */
    public function listProducts(array $params = []): array
    {
        return $this->apiGet('/api/v1/products', $params);
    }

    // Payments

    /**
     * List payments with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. per_page, page, client_id).
     * @return array<string, mixed>
     */
    public function listPayments(array $params = []): array
    {
        return $this->apiGet('/api/v1/payments', $params);
    }

    // Users

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/api/v1/users/me');
    }

    // Generic REST helpers

    /**
     * Send a GET request to an Invoice Ninja endpoint.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Send a POST request to an Invoice Ninja endpoint.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $data = [], array $query = []): array
    {
        return $this->request('POST', $path, $data, $query);
    }

    /**
     * Send a PUT request to an Invoice Ninja endpoint.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PUT', $path, $data, $query);
    }

    /**
     * Send a DELETE request to an Invoice Ninja endpoint.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    // HTTP

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Invoice Ninja API.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     *
     * @throws RuntimeException  On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        if (! $this->apiToken) {
            throw new RuntimeException('Invoice Ninja API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-API-TOKEN' => $this->apiToken,
                'X-Requested-With' => 'XMLHttpRequest',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->withOptions(['query' => $query])->post($url, $data),
                'PUT' => $http->withOptions(['query' => $query])->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Invoice Ninja API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Invoice Ninja API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Invoice Ninja API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException('Invoice Ninja API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Invoice Ninja API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Invoice Ninja API: {$e->getMessage()}");
        }
    }
}
