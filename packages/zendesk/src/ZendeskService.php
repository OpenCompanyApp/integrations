<?php

namespace OpenCompany\Integrations\Zendesk;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Zendesk REST API covering tickets, users, and organizations.
 *
 * Wraps the Zendesk API v2 with Bearer token authentication, request routing, and error reporting.
 */
class ZendeskService
{
    /**
     * @param  string  $accessToken  Zendesk OAuth or API token
     * @param  string  $baseUrl      Zendesk API base URL (default: https://api.zendesk.com/v2)
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.zendesk.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Tickets ────────────────────────────────────────────

    /**
     * List tickets with optional pagination and filtering.
     *
     * @param  array<string, mixed>  $params  Query params: per_page, page, sort_by, sort_order, status
     * @return array<string, mixed>
     */
    public function listTickets(array $params = []): array
    {
        return $this->request('GET', '/tickets', $params);
    }

    /**
     * Get a ticket by ID.
     *
     * @return array<string, mixed>
     */
    public function getTicket(string $id): array
    {
        return $this->request('GET', "/tickets/{$id}");
    }

    /**
     * Create a ticket.
     *
     * @param  array<string, mixed>  $data  Ticket fields (subject, description, priority, status, etc.)
     * @return array<string, mixed>
     */
    public function createTicket(array $data): array
    {
        return $this->request('POST', '/tickets', $data);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * List users with optional pagination and filtering.
     *
     * @param  array<string, mixed>  $params  Query params: per_page, page, role, sort_by, sort_order
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a user by ID.
     *
     * @return array<string, mixed>
     */
    public function getUser(string $id): array
    {
        return $this->request('GET', "/users/{$id}");
    }

    // ── Organizations ──────────────────────────────────────

    /**
     * List organizations with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query params: per_page, page
     * @return array<string, mixed>
     */
    public function listOrganizations(array $params = []): array
    {
        return $this->request('GET', '/organizations', $params);
    }

    // ── Me (current user) ──────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getMe(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Zendesk access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['error'] ?? $body['description'] ?? $body['message'] ?? $response->body();

                if (is_array($err)) {
                    $err = json_encode($err);
                }

                Log::error("Zendesk API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                throw new \RuntimeException('Zendesk API error (' . $response->status() . '): ' . $err);
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
