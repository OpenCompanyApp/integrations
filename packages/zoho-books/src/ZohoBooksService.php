<?php

namespace OpenCompany\Integrations\ZohoBooks;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * ZohoBooksService handles all HTTP communication with the Zoho Books API.
 *
 * This service encapsulates authentication, request execution, and error
 * handling for the Zoho Books REST API (v3). It uses an OAuth access token
 * and requires an organization_id for most operations.
 */
class ZohoBooksService
{
    /**
     * Create a new ZohoBooksService instance.
     *
     * @param  string  $accessToken  OAuth2 access token for Zoho Books API authentication.
     * @param  string  $organizationId  The Zoho Books organization ID (required for most API calls).
     * @param  string  $baseUrl  The base URL for the Zoho Books API (default: https://www.zohoapis.com/books/v3).
     */
    public function __construct(
        private string $accessToken = '',
        private string $organizationId = '',
        private string $baseUrl = 'https://www.zohoapis.com/books/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->organizationId);
    }

    /**
     * Get the configured organization ID.
     */
    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    /**
     * List invoices for the organization.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., status, date, customer_id, page).
     * @return array<string, mixed> The API response containing invoices.
     */
    public function listInvoices(array $params = []): array
    {
        return $this->request('GET', '/invoices', $params);
    }

    /**
     * Get a single invoice by ID.
     *
     * @param  string  $id  The invoice ID.
     * @return array<string, mixed> The invoice data.
     */
    public function getInvoice(string $id): array
    {
        return $this->request('GET', '/invoices/' . urlencode($id));
    }

    /**
     * Create a new invoice.
     *
     * @param  array<string, mixed>  $data  Invoice data (customer_id, line_items, date, due_date, etc.).
     * @return array<string, mixed> The created invoice data.
     */
    public function createInvoice(array $data): array
    {
        return $this->request('POST', '/invoices', [], $data);
    }

    /**
     * Update an existing invoice.
     *
     * @param  string  $id  The invoice ID to update.
     * @param  array<string, mixed>  $data  Invoice fields to update.
     * @return array<string, mixed> The updated invoice data.
     */
    public function updateInvoice(string $id, array $data): array
    {
        return $this->request('PUT', '/invoices/' . urlencode($id), [], $data);
    }

    /**
     * List contacts (customers/vendors) for the organization.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., contact_type, page).
     * @return array<string, mixed> The API response containing contacts.
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $id  The contact ID.
     * @return array<string, mixed> The contact data.
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/contacts/' . urlencode($id));
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact data (name, email, phone, etc.).
     * @return array<string, mixed> The created contact data.
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', [], $data);
    }

    /**
     * List items (products/services) for the organization.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., filter_type, page).
     * @return array<string, mixed> The API response containing items.
     */
    public function listItems(array $params = []): array
    {
        return $this->request('GET', '/items', $params);
    }

    /**
     * Create a new item (product or service).
     *
     * @param  array<string, mixed>  $data  Item data (name, rate, description, unit, item_type, etc.).
     * @return array<string, mixed> The created item data.
     */
    public function createItem(array $data): array
    {
        return $this->request('POST', '/items', [], $data);
    }

    /**
     * List estimates for the organization.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., status, customer_id, page).
     * @return array<string, mixed> The API response containing estimates.
     */
    public function listEstimates(array $params = []): array
    {
        return $this->request('GET', '/estimates', $params);
    }

    /**
     * Create a new estimate.
     *
     * @param  array<string, mixed>  $data  Estimate data (customer_id, line_items, date, expiry_date, etc.).
     * @return array<string, mixed> The created estimate data.
     */
    public function createEstimate(array $data): array
    {
        return $this->request('POST', '/estimates', [], $data);
    }

    /**
     * Get the current (authenticated) user's information.
     *
     * @return array<string, mixed> The user data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., '/invoices').
     * @param  array<string, mixed>  $query  Query parameters to append to the URL.
     * @param  array<string, mixed>  $body  Request body (for POST/PUT requests).
     * @return array<string, mixed> The parsed JSON response.
     *
     * @throws \RuntimeException If the service is not configured or the API returns an error.
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Zoho Books API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  Request body for POST/PUT.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException On authentication, connection, or API errors.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Zoho Books access token is not configured.');
        }

        if (!$this->organizationId) {
            throw new \RuntimeException('Zoho Books organization ID is not configured.');
        }

        $url = $this->baseUrl . $path;

        // Always include organization_id as a query parameter (Zoho Books requirement).
        $query['organization_id'] = $this->organizationId;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Zoho-oauthtoken ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($url, array_merge($query, $body)),
                'PUT' => $http->put($url, array_merge($query, $body)),
                'DELETE' => $http->delete($url, $query),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['message'] ?? $response->body();

                Log::error("Zoho Books API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Zoho Books API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoho Books API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zoho Books API: {$e->getMessage()}");
        }
    }
}
