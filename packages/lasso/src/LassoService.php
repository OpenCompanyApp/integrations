<?php

namespace OpenCompany\Integrations\Lasso;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Lasso CRM API service.
 *
 * Handles HTTP communication with the Lasso CRM API using Bearer token
 * authentication. Provides methods for contacts, deals, inventory, and
 * user management.
 *
 * @see https://api.lassocrm.com/v1
 */
class LassoService
{
    /**
     * Create a new LassoService instance.
     *
     * @param  string  $token  Lasso CRM API bearer token.
     * @param  string  $baseUrl  Base URL for the Lasso API (defaults to https://api.lassocrm.com/v1).
     */
    public function __construct(
        private string $token = '',
        private string $baseUrl = 'https://api.lassocrm.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API token.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->token);
    }

    // ─── Contacts ─────────────────────────────────────────────────────────

    /**
     * List contacts with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $filters  Optional filters (e.g., registrant_id, project_id, etc.).
     * @param  int  $limit  Maximum number of contacts to return (default 25).
     * @param  int|null  $page  Page number for pagination.
     * @return array<string, mixed> API response containing contacts and pagination info.
     */
    public function listContacts(array $filters = [], int $limit = 25, ?int $page = null): array
    {
        $params = array_merge($filters, ['limit' => $limit]);
        if ($page !== null) {
            $params['page'] = $page;
        }

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
     * @param  array<string, mixed>  $data  Contact data (first_name, last_name, emails, phones, etc.).
     * @return array<string, mixed> The created contact data.
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', $data);
    }

    // ─── Deals ────────────────────────────────────────────────────────────

    /**
     * List deals with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $filters  Optional filters (e.g., project_id, status, etc.).
     * @param  int  $limit  Maximum number of deals to return (default 25).
     * @param  int|null  $page  Page number for pagination.
     * @return array<string, mixed> API response containing deals and pagination info.
     */
    public function listDeals(array $filters = [], int $limit = 25, ?int $page = null): array
    {
        $params = array_merge($filters, ['limit' => $limit]);
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/deals', $params);
    }

    /**
     * Get a single deal by ID.
     *
     * @param  string  $id  The deal ID.
     * @return array<string, mixed> The deal data.
     */
    public function getDeal(string $id): array
    {
        return $this->request('GET', '/deals/' . urlencode($id));
    }

    // ─── Inventory ────────────────────────────────────────────────────────

    /**
     * List inventory (available units/lots) with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $filters  Optional filters (e.g., project_id, status, etc.).
     * @param  int  $limit  Maximum number of inventory items to return (default 25).
     * @param  int|null  $page  Page number for pagination.
     * @return array<string, mixed> API response containing inventory and pagination info.
     */
    public function listInventory(array $filters = [], int $limit = 25, ?int $page = null): array
    {
        $params = array_merge($filters, ['limit' => $limit]);
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/inventory', $params);
    }

    // ─── User ─────────────────────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The user profile data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    // ─── Internal helpers ─────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g. "/contacts").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> Parsed JSON response.
     *
     * @throws \RuntimeException On API errors or connection failures.
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
     * Make a raw HTTP request to the Lasso CRM API using Bearer token auth.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PUT/DELETE).
     * @return Response The raw HTTP response.
     *
     * @throws \RuntimeException On API errors, connection failures, or missing token.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->token) {
            throw new \RuntimeException('Lasso CRM API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withToken($this->token)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Lasso API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Lasso API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $errors = $response->json('errors') ?? $response->json('error') ?? $body;
                Log::error("Lasso API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $errors,
                ]);
                throw new \RuntimeException("Lasso API error ({$response->status()}): " . (is_string($errors) ? $errors : json_encode($errors)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Lasso API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Lasso API: {$e->getMessage()}");
        }
    }
}
