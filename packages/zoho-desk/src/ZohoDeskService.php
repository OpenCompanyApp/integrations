<?php

namespace OpenCompany\Integrations\ZohoDesk;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZohoDeskService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://desk.zoho.com/api/v1',
        private string $orgId = '',
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
     * List tickets with optional filters.
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
     * @param  array<string, mixed>  $data  Fields to update (status, priority, assigneeId, etc.).
     * @return array<string, mixed>
     */
    public function updateTicket(string $ticketId, array $data): array
    {
        return $this->request('PATCH', '/tickets/' . urlencode($ticketId), $data);
    }

    /**
     * List contacts with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., from, limit, search).
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    /**
     * List knowledge base articles.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., departmentId, from, limit).
     * @return array<string, mixed>
     */
    public function listArticles(array $params = []): array
    {
        return $this->request('GET', '/articles', $params);
    }

    /**
     * List departments.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., from, limit).
     * @return array<string, mixed>
     */
    public function listDepartments(array $params = []): array
    {
        return $this->request('GET', '/departments', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data
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
     * Make a raw HTTP request to the Zoho Desk API.
     *
     * @param  array<string, mixed>  $data
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
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
                'PATCH' => $http->patch($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Zoho Desk API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Zoho Desk API endpoint not available (HTTP {$response->status()}). Check your configuration and org ID.");
                }

                $error = $response->json('errors') ?? $response->json('message') ?? $body;
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
