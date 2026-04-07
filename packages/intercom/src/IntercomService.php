<?php

namespace OpenCompany\Integrations\Intercom;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Intercom REST API covering conversations, contacts, and companies.
 *
 * Wraps the Intercom API v2.11 with Bearer token authentication, request routing, and error reporting.
 */
class IntercomService
{
    /**
     * @param  string  $accessToken  Intercom personal access token
     * @param  string  $baseUrl      Intercom API base URL (default: https://api.intercom.io/v1)
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.intercom.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Conversations ──────────────────────────────────────

    /**
     * List conversations with optional pagination, sorting, and status filter.
     *
     * @param  array<string, mixed>  $params  Query params: limit, starting_after, sort_order, status
     * @return array<string, mixed>
     */
    public function listConversations(array $params = []): array
    {
        return $this->request('GET', '/conversations', $params);
    }

    /**
     * Get a conversation by ID.
     *
     * @return array<string, mixed>
     */
    public function getConversation(string $id): array
    {
        return $this->request('GET', "/conversations/{$id}");
    }

    /**
     * Create a conversation.
     *
     * @param  array<string, mixed>  $data  Conversation fields (from, body)
     * @return array<string, mixed>
     */
    public function createConversation(array $data): array
    {
        return $this->request('POST', '/conversations', $data);
    }

    // ── Contacts ───────────────────────────────────────────

    /**
     * List contacts with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query params: limit, starting_after
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a contact by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', "/contacts/{$id}");
    }

    // ── Companies ──────────────────────────────────────────

    /**
     * List companies with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query params: limit, starting_after
     * @return array<string, mixed>
     */
    public function listCompanies(array $params = []): array
    {
        return $this->request('GET', '/companies', $params);
    }

    // ── Me (current user) ──────────────────────────────────

    /**
     * Get the current admin (authenticated user).
     *
     * @return array<string, mixed>
     */
    public function getMe(): array
    {
        return $this->request('GET', '/me');
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
            throw new \RuntimeException('Intercom access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Intercom-Version' => '2.11',
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
                $err = $body['errors'] ?? $body['message'] ?? $response->body();

                if (is_array($err)) {
                    $err = collect($err)->map(fn ($e) => ($e['message'] ?? json_encode($e)))->implode('; ');
                }

                Log::error("Intercom API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => is_string($err) ? $err : json_encode($err),
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Intercom API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Intercom API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Intercom API: {$e->getMessage()}");
        }
    }
}
