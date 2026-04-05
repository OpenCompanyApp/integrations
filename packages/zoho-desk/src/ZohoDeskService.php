<?php

namespace OpenCompany\Integrations\ZohoDesk;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZohoDeskService
{
    /**
     * Create a new ZohoDeskService instance.
     *
     * @param  string  $accessToken  OAuth2 access token for Zoho Desk API.
     * @param  string  $baseUrl  Base URL for the Zoho Desk API (e.g., https://desk.zoho.com/api/v1).
     * @param  string  $orgId  Zoho Desk organization ID (sent as orgId header).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://desk.zoho.com/api/v1',
        private string $orgId = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    /**
     * Get the configured organization ID.
     */
    public function getOrgId(): string
    {
        return $this->orgId;
    }

    /**
     * List tickets with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., departmentId, status, from, limit).
     * @return array<string, mixed>
     */
    public function listTickets(array $params = []): array
    {
        return $this->request('GET', '/tickets', $params);
    }

    /**
     * Get a single ticket by ID.
     *
     * @param  string  $ticketId  The ticket ID.
     * @return array<string, mixed>
     */
    public function getTicket(string $ticketId): array
    {
        return $this->request('GET', '/tickets/' . urlencode($ticketId));
    }

    /**
     * Create a new ticket.
     *
     * @param  array<string, mixed>  $data  Ticket data (subject, departmentId, contactId, description, etc.).
     * @return array<string, mixed>
     */
    public function createTicket(array $data): array
    {
        return $this->request('POST', '/tickets', $data);
    }

    /**
     * Update an existing ticket.
     *
     * @param  string  $ticketId  The ticket ID.
     * @param  array<string, mixed>  $data  Fields to update (status, priority, assigneeId, etc.).
     * @return array<string, mixed>
     */
    public function updateTicket(string $ticketId, array $data): array
    {
        return $this->request('PATCH', '/tickets/' . urlencode($ticketId), $data);
    }

    /**
     * List contacts with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., from, limit, search).
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    /**
     * List knowledge base articles with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., departmentId, categoryId, from, limit).
     * @return array<string, mixed>
     */
    public function listArticles(array $params = []): array
    {
        return $this->request('GET', '/articles', $params);
    }

    /**
     * List all departments in the organization.
     *
     * @return array<string, mixed>
     */
    public function listDepartments(): array
    {
        return $this->request('GET', '/departments');
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return the parsed JSON response.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Request body (POST/PATCH/PUT) or query params (GET).
     * @return array<string, mixed>
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Zoho Desk API.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On missing credentials, connection failure, or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Zoho Desk access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders(array_filter([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'orgId' => $this->orgId ?: null,
            ]))->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Zoho Desk API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Zoho Desk API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be unavailable.");
                }

                $error = $response->json('errors.0.message')
                    ?? $response->json('message')
                    ?? $response->json('error')
                    ?? $body;

                Log::error("Zoho Desk API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Zoho Desk API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoho Desk API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zoho Desk API: {$e->getMessage()}");
        }
    }
}
