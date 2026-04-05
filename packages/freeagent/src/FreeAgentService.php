<?php

namespace OpenCompany\Integrations\FreeAgent;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FreeAgentService
{
    /**
     * Create a new FreeAgent service instance.
     *
     * @param  string  $accessToken  OAuth2 access token for the FreeAgent API.
     * @param  string  $baseUrl  Base URL for the FreeAgent API (default: https://api.freeagent.com/v2).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.freeagent.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List invoices.
     *
     * @param  array  $params  Optional query parameters (e.g. view, from_date, to_date, status, contact, project).
     * @return array<string, mixed> The parsed JSON response containing invoices.
     */
    public function listInvoices(array $params = []): array
    {
        return $this->request('GET', '/invoices', $params);
    }

    /**
     * Get a single invoice by ID.
     *
     * @param  int  $invoiceId  The invoice ID.
     * @return array<string, mixed> The parsed JSON response containing the invoice.
     */
    public function getInvoice(int $invoiceId): array
    {
        return $this->request('GET', '/invoices/' . $invoiceId);
    }

    /**
     * Create a new invoice.
     *
     * @param  array<string, mixed>  $data  Invoice data (contact, dated_on, invoice_items, etc.).
     * @return array<string, mixed> The parsed JSON response containing the created invoice.
     */
    public function createInvoice(array $data): array
    {
        return $this->request('POST', '/invoices', ['invoice' => $data]);
    }

    /**
     * List contacts.
     *
     * @param  array  $params  Optional query parameters (e.g. view, order, created_since).
     * @return array<string, mixed> The parsed JSON response containing contacts.
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  int  $contactId  The contact ID.
     * @return array<string, mixed> The parsed JSON response containing the contact.
     */
    public function getContact(int $contactId): array
    {
        return $this->request('GET', '/contacts/' . $contactId);
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact data (first_name, last_name, email, organisation_name, etc.).
     * @return array<string, mixed> The parsed JSON response containing the created contact.
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', ['contact' => $data]);
    }

    /**
     * List projects.
     *
     * @param  array  $params  Optional query parameters (e.g. view, contact, status).
     * @return array<string, mixed> The parsed JSON response containing projects.
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    /**
     * List expenses.
     *
     * @param  array  $params  Optional query parameters (e.g. view, from_date, to_date, contact, project).
     * @return array<string, mixed> The parsed JSON response containing expenses.
     */
    public function listExpenses(array $params = []): array
    {
        return $this->request('GET', '/expenses', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The parsed JSON response containing the user.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string  $path  API path (e.g. /invoices).
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the FreeAgent API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('FreeAgent access token is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("FreeAgent API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("FreeAgent API endpoint not available (HTTP {$response->status()}). Check your access token and API URL.");
                }

                $error = $response->json('error') ?? $response->json('errors') ?? $body;
                Log::error("FreeAgent API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("FreeAgent API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("FreeAgent API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to FreeAgent API: {$e->getMessage()}");
        }
    }
}
