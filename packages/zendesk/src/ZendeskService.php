<?php

namespace OpenCompany\Integrations\Zendesk;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Zendesk REST API v2.
 *
 * Provides methods for tickets, users, groups, help center articles,
 * macros, tags, and ticket fields using Basic Auth with API tokens.
 */
class ZendeskService
{
    /**
     * @param  string  $email      Zendesk account email address
     * @param  string  $apiToken   Zendesk API token
     * @param  string  $subdomain  Zendesk account subdomain
     */
    public function __construct(
        private string $email = '',
        private string $apiToken = '',
        private string $subdomain = '',
    ) {}

    /**
     * Check whether the Zendesk credentials have been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->email) && ! empty($this->apiToken) && ! empty($this->subdomain);
    }

    /*-----------------------------------------------------------------------
     | Tickets
     *---------------------------------------------------------------------*/

    /**
     * Create a new ticket.
     *
     * @param  array<string, mixed>  $data  Ticket data wrapped in a "ticket" key
     * @return array<string, mixed>
     */
    public function createTicket(array $data): array
    {
        return $this->request('POST', '/tickets.json', $data);
    }

    /**
     * Get details for a specific ticket.
     *
     * @return array<string, mixed>
     */
    public function getTicket(int $ticketId): array
    {
        return $this->request('GET', "/tickets/{$ticketId}.json");
    }

    /**
     * Update an existing ticket.
     *
     * @param  array<string, mixed>  $data  Ticket fields to update, wrapped in a "ticket" key
     * @return array<string, mixed>
     */
    public function updateTicket(int $ticketId, array $data): array
    {
        return $this->request('PUT', "/tickets/{$ticketId}.json", $data);
    }

    /**
     * Delete a ticket.
     *
     * @return array<string, mixed>
     */
    public function deleteTicket(int $ticketId): array
    {
        return $this->request('DELETE', "/tickets/{$ticketId}.json");
    }

    /**
     * List tickets with optional pagination and sorting.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, page, sort_by, sort_order)
     * @return array<string, mixed>
     */
    public function listTickets(array $params = []): array
    {
        return $this->request('GET', '/tickets.json', $params);
    }

    /**
     * Search tickets using Zendesk query syntax.
     *
     * @param  array<string, mixed>  $params  Query parameters (query, per_page, page)
     * @return array<string, mixed>
     */
    public function searchTickets(array $params): array
    {
        return $this->request('GET', '/search.json', $params);
    }

    /**
     * List comments on a ticket.
     *
     * @return array<string, mixed>
     */
    public function listTicketComments(int $ticketId): array
    {
        return $this->request('GET', "/tickets/{$ticketId}/comments.json");
    }

    /**
     * List ticket fields (custom and system fields).
     *
     * @return array<string, mixed>
     */
    public function listTicketFields(): array
    {
        return $this->request('GET', '/ticket_fields.json');
    }

    /*-----------------------------------------------------------------------
     | Users & Groups
     *---------------------------------------------------------------------*/

    /**
     * Get details for a specific user.
     *
     * @return array<string, mixed>
     */
    public function getUser(int $userId): array
    {
        return $this->request('GET', "/users/{$userId}.json");
    }

    /**
     * List users with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (role, per_page, page)
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users.json', $params);
    }

    /**
     * Create a new user.
     *
     * @param  array<string, mixed>  $data  User data wrapped in a "user" key
     * @return array<string, mixed>
     */
    public function createUser(array $data): array
    {
        return $this->request('POST', '/users.json', $data);
    }

    /**
     * List groups.
     *
     * @return array<string, mixed>
     */
    public function listGroups(): array
    {
        return $this->request('GET', '/groups.json');
    }

    /*-----------------------------------------------------------------------
     | Help Center
     *---------------------------------------------------------------------*/

    /**
     * Search Help Center articles.
     *
     * @param  array<string, mixed>  $params  Query parameters (query, section, category, per_page, page)
     * @return array<string, mixed>
     */
    public function searchArticles(array $params): array
    {
        return $this->request('GET', '/help_center/articles/search.json', $params);
    }

    /**
     * Get a specific Help Center article.
     *
     * @return array<string, mixed>
     */
    public function getArticle(int $articleId): array
    {
        return $this->request('GET', "/help_center/articles/{$articleId}.json");
    }

    /**
     * Create a Help Center article in a section.
     *
     * @param  array<string, mixed>  $data  Article data wrapped in an "article" key
     * @return array<string, mixed>
     */
    public function createArticle(int $sectionId, array $data): array
    {
        return $this->request('POST', "/help_center/sections/{$sectionId}/articles.json", $data);
    }

    /**
     * List Help Center sections.
     *
     * @return array<string, mixed>
     */
    public function listSections(): array
    {
        return $this->request('GET', '/help_center/sections.json');
    }

    /*-----------------------------------------------------------------------
     | Macros & Tags
     *---------------------------------------------------------------------*/

    /**
     * List available macros.
     *
     * @return array<string, mixed>
     */
    public function listMacros(): array
    {
        return $this->request('GET', '/macros.json');
    }

    /**
     * Apply a macro to a ticket.
     *
     * @return array<string, mixed>
     */
    public function applyMacro(int $ticketId, int $macroId): array
    {
        return $this->request('POST', "/tickets/{$ticketId}/macros/{$macroId}/apply.json");
    }

    /**
     * Add tags to a ticket (appends to existing tags).
     *
     * @param  array<int, string>  $tags
     * @return array<string, mixed>
     */
    public function addTags(int $ticketId, array $tags): array
    {
        return $this->request('POST', "/tickets/{$ticketId}/tags.json", ['tags' => $tags]);
    }

    /**
     * Set tags on a ticket (replaces all existing tags).
     *
     * @param  array<int, string>  $tags
     * @return array<string, mixed>
     */
    public function setTags(int $ticketId, array $tags): array
    {
        return $this->request('PUT', "/tickets/{$ticketId}/tags.json", ['tags' => $tags]);
    }

    /*-----------------------------------------------------------------------
     | Connection Test
     *---------------------------------------------------------------------*/

    /**
     * Test the API connection by fetching the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/users/me.json');
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    /**
     * Make an authenticated API request to Zendesk REST API v2.
     *
     * Uses HTTP Basic Auth with the email/token convention.
     *
     * @param  array<string, mixed>  $params  Query or body parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        $baseUrl = "https://{$this->subdomain}.zendesk.com/api/v2";
        $url = $baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->email . '/token', $this->apiToken)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error'] ?? $body['description'] ?? $response->body();

                Log::error("Zendesk API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Zendesk API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zendesk API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zendesk API: {$e->getMessage()}");
        }
    }
}
