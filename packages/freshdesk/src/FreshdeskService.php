<?php

namespace OpenCompany\Integrations\Freshdesk;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Freshdesk API service — handles HTTP communication with the Freshdesk v2 REST API.
 *
 * Uses HTTP Basic Auth with the API key as the username and "X" as the password.
 * The domain is embedded in the base URL: https://{domain}.freshdesk.com/api/v2
 */
class FreshdeskService
{
    /**
     * @param  string  $apiKey  Freshdesk API key
     * @param  string  $domain  Freshdesk account domain (e.g., "mycompany")
     */
    public function __construct(
        private string $apiKey = '',
        private string $domain = '',
    ) {
        $this->domain = rtrim($this->domain, '/');
    }

    /**
     * Check whether the service has enough configuration to make API calls.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->domain);
    }

    /**
     * Get the authenticated user (agent) — used for connection testing.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/agents/me');
    }

    // ── Tickets ──────────────────────────────────────────────────────────────

    /**
     * List tickets with optional filters and pagination.
     *
     * @param  array<string, mixed>  $filters  Query parameters (page, per_page, filter, etc.)
     * @return array<string, mixed>
     */
    public function listTickets(array $filters = []): array
    {
        return $this->request('GET', '/tickets', $filters);
    }

    /**
     * Get a single ticket by ID.
     *
     * @return array<string, mixed>
     */
    public function getTicket(int $ticketId): array
    {
        return $this->request('GET', '/tickets/' . $ticketId);
    }

    /**
     * Create a new ticket.
     *
     * @param  array<string, mixed>  $data  Ticket fields (subject, description, email, priority, status, etc.)
     * @return array<string, mixed>
     */
    public function createTicket(array $data): array
    {
        return $this->request('POST', '/tickets', $data);
    }

    /**
     * Update an existing ticket.
     *
     * @param  array<string, mixed>  $data  Fields to update
     * @return array<string, mixed>
     */
    public function updateTicket(int $ticketId, array $data): array
    {
        return $this->request('PUT', '/tickets/' . $ticketId, $data);
    }

    /**
     * Delete a ticket.
     */
    public function deleteTicket(int $ticketId): void
    {
        $this->request('DELETE', '/tickets/' . $ticketId);
    }

    // ──Contacts ──────────────────────────────────────────────────────────────

    /**
     * List contacts with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, per_page, etc.)
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(int $contactId): array
    {
        return $this->request('GET', '/contacts/' . $contactId);
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact fields (email, name, etc.)
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', $data);
    }

    // ──Agents ────────────────────────────────────────────────────────────────

    /**
     * List all agents.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listAgents(array $params = []): array
    {
        return $this->request('GET', '/agents', $params);
    }

    /**
     * Get a single agent by ID.
     *
     * @return array<string, mixed>
     */
    public function getAgent(int $agentId): array
    {
        return $this->request('GET', '/agents/' . $agentId);
    }

    // ──Conversations ─────────────────────────────────────────────────────────

    /**
     * List conversations for a ticket.
     *
     * @return array<string, mixed>
     */
    public function listConversations(int $ticketId): array
    {
        return $this->request('GET', '/tickets/' . $ticketId . '/conversations');
    }

    /**
     * Create a reply on a ticket.
     *
     * @param  array<string, mixed>  $data  Reply fields (body, etc.)
     * @return array<string, mixed>
     */
    public function createReply(int $ticketId, array $data): array
    {
        return $this->request('POST', '/tickets/' . $ticketId . '/reply', $data);
    }

    /**
     * Create a private note on a ticket.
     *
     * @param  array<string, mixed>  $data  Note fields (body, etc.)
     * @return array<string, mixed>
     */
    public function createNote(int $ticketId, array $data): array
    {
        return $this->request('POST', '/tickets/' . $ticketId . '/notes', $data);
    }

    // ──Companies ─────────────────────────────────────────────────────────────

    /**
     * List companies with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, etc.)
     * @return array<string, mixed>
     */
    public function listCompanies(array $params = []): array
    {
        return $this->request('GET', '/companies', $params);
    }

    // ──HTTP layer ────────────────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API path (e.g., "/tickets")
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PUT)
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
     * Make a raw HTTP request to the Freshdesk API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path    API path
     * @param  array<string, mixed>  $data  Query params or body
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->domain) {
            throw new \RuntimeException('Freshdesk API key and domain are not configured.');
        }

        $url = 'https://' . $this->domain . '.freshdesk.com/api/v2' . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, 'X')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('errors') ?? $response->body();
                Log::error("Freshdesk API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException(
                    "Freshdesk API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Freshdesk API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Freshdesk API: {$e->getMessage()}");
        }
    }
}
