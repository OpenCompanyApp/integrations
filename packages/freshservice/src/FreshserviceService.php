<?php

namespace OpenCompany\Integrations\Freshservice;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FreshserviceService
{
    /**
     * Create a new Freshservice service instance.
     *
     * @param  string  $apiKey  The Freshservice API key.
     * @param  string  $domain  The Freshservice domain (e.g., "acme" for acme.freshservice.com).
     */
    public function __construct(
        private string $apiKey = '',
        private string $domain = '',
    ) {
        $this->domain = rtrim($this->domain, '/');
    }

    /**
     * Check whether the service is configured with an API key and domain.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->domain);
    }

    /**
     * Get the configured domain.
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Build the base URL for the Freshservice API v2.
     *
     * @return string The full base URL, e.g. "https://acme.freshservice.com/api/v2".
     */
    private function baseUrl(): string
    {
        return "https://{$this->domain}.freshservice.com/api/v2";
    }

    // ─── Tickets ───────────────────────────────────────────────────────

    /**
     * List tickets with optional pagination and filtering.
     *
     * @param  int|null  $page     The page number (1-based).
     * @param  int|null  $perPage  Results per page (max 100).
     * @param  string|null  $filter  Predefined filter name (e.g., "new_and_my_open", "watching", "spam", "deleted").
     * @return array<string, mixed> The API response containing tickets.
     */
    public function listTickets(?int $page = null, ?int $perPage = null, ?string $filter = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        if ($filter !== null) {
            $params['filter'] = $filter;
        }

        return $this->request('GET', '/tickets', $params);
    }

    /**
     * Get a single ticket by ID.
     *
     * @param  int  $ticketId  The ticket display ID.
     * @return array<string, mixed> The ticket data.
     */
    public function getTicket(int $ticketId): array
    {
        return $this->request('GET', '/tickets/' . $ticketId);
    }

    /**
     * Create a new ticket.
     *
     * @param  string  $subject     The ticket subject.
     * @param  string  $description The ticket description (HTML).
     * @param  string|null  $email   The requester's email address.
     * @param  int|null  $priority   Priority level (1=Low, 2=Medium, 3=High, 4=Urgent).
     * @param  array<string, mixed>  $additional  Additional ticket fields.
     * @return array<string, mixed> The created ticket data.
     */
    public function createTicket(string $subject, string $description, ?string $email = null, ?int $priority = null, array $additional = []): array
    {
        $data = array_merge($additional, [
            'subject' => $subject,
            'description' => $description,
        ]);

        if ($email !== null) {
            $data['email'] = $email;
        }
        if ($priority !== null) {
            $data['priority'] = $priority;
        }

        return $this->request('POST', '/tickets', $data);
    }

    /**
     * Update an existing ticket.
     *
     * @param  int  $ticketId  The ticket display ID.
     * @param  array<string, mixed>  $data  The fields to update.
     * @return array<string, mixed> The updated ticket data.
     */
    public function updateTicket(int $ticketId, array $data): array
    {
        return $this->request('PUT', '/tickets/' . $ticketId, $data);
    }

    /**
     * Delete a ticket.
     *
     * @param  int  $ticketId  The ticket display ID.
     */
    public function deleteTicket(int $ticketId): void
    {
        $this->request('DELETE', '/tickets/' . $ticketId);
    }

    // ─── Agents ────────────────────────────────────────────────────────

    /**
     * List all agents in the Freshservice account.
     *
     * @param  string|null  $page  The page cursor for pagination.
     * @return array<string, mixed> The API response containing agents.
     */
    public function listAgents(?string $page = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/agents', $params);
    }

    /**
     * Get a single agent by ID.
     *
     * @param  int  $agentId  The agent ID.
     * @return array<string, mixed> The agent data.
     */
    public function getAgent(int $agentId): array
    {
        return $this->request('GET', '/agents/' . $agentId);
    }

    /**
     * Get the currently authenticated agent.
     *
     * @return array<string, mixed> The current agent's data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/agents/me');
    }

    // ─── Assets ────────────────────────────────────────────────────────

    /**
     * List assets with optional pagination.
     *
     * @param  int|null  $page  The page number (1-based).
     * @return array<string, mixed> The API response containing assets.
     */
    public function listAssets(?int $page = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/assets', $params);
    }

    /**
     * Get a single asset by display ID.
     *
     * @param  int  $assetId  The asset display ID.
     * @return array<string, mixed> The asset data.
     */
    public function getAsset(int $assetId): array
    {
        return $this->request('GET', '/assets/' . $assetId);
    }

    // ─── HTTP Layer ────────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Freshservice API v2.
     *
     * Uses HTTP Basic Auth with the API key as the username and "X" as the password.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the service is not configured or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->domain) {
            throw new \RuntimeException('Freshservice API key and domain are not configured.');
        }

        $url = $this->baseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apiKey, 'X')->timeout(30);

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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Freshservice API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Freshservice API endpoint not available (HTTP {$response->status()}). The domain or endpoint may be incorrect.");
                }

                $error = $response->json('errors') ?? $response->json('error') ?? $body;
                Log::error("Freshservice API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Freshservice API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Freshservice API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Freshservice API: {$e->getMessage()}");
        }
    }
}
