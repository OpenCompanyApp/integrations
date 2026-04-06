<?php

namespace OpenCompany\Integrations\Intercom;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Intercom REST API covering contacts, conversations, admins, tags, notes, and companies.
 *
 * Wraps the Intercom API v2.11 with Bearer token authentication, request routing, and error reporting.
 */
class IntercomService
{
    /**
     * @param  string  $accessToken  Intercom personal access token
     * @param  string  $baseUrl      Intercom API base URL (default: https://api.intercom.io)
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.intercom.io',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Contacts ───────────────────────────────────────────

    /**
     * Create a contact.
     *
     * @param  array<string, mixed>  $data  Contact fields (email, name, phone, role, custom_attributes)
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', $data);
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

    /**
     * Update a contact by ID.
     *
     * @param  array<string, mixed>  $data  Fields to update (name, email, phone, custom_attributes)
     * @return array<string, mixed>
     */
    public function updateContact(string $id, array $data): array
    {
        return $this->request('PUT', "/contacts/{$id}", $data);
    }

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
     * Search contacts using Intercom query structure.
     *
     * @param  array<string, mixed>  $body  Search body with query, pagination
     * @return array<string, mixed>
     */
    public function searchContacts(array $body = []): array
    {
        return $this->request('POST', '/contacts/search', $body);
    }

    /**
     * Delete a contact by ID.
     *
     * @return array<string, mixed>
     */
    public function deleteContact(string $id): array
    {
        return $this->request('DELETE', "/contacts/{$id}");
    }

    // ── Conversations ──────────────────────────────────────

    /**
     * Create a conversation.
     *
     * @param  array<string, mixed>  $data  Conversation fields (user_id, body)
     * @return array<string, mixed>
     */
    public function createConversation(array $data): array
    {
        return $this->request('POST', '/conversations', $data);
    }

    /**
     * Reply to a conversation.
     *
     * @param  string  $id     Conversation ID
     * @param  array<string, mixed>  $data  Reply fields (message_type, body, admin_id)
     * @return array<string, mixed>
     */
    public function replyConversation(string $id, array $data): array
    {
        return $this->request('POST', "/conversations/{$id}/reply", $data);
    }

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

    // ── Admins ─────────────────────────────────────────────

    /**
     * List admins.
     *
     * @return array<string, mixed>
     */
    public function listAdmins(): array
    {
        return $this->request('GET', '/admins');
    }

    // ── Tags ───────────────────────────────────────────────

    /**
     * List tags.
     *
     * @return array<string, mixed>
     */
    public function listTags(): array
    {
        return $this->request('GET', '/tags');
    }

    /**
     * Tag contacts.
     *
     * @param  array<string, mixed>  $data  Tag fields (name, contact_ids)
     * @return array<string, mixed>
     */
    public function tagContacts(array $data): array
    {
        return $this->request('POST', '/tags', $data);
    }

    // ── Notes ──────────────────────────────────────────────

    /**
     * Create a note on a contact.
     *
     * @param  array<string, mixed>  $data  Note fields (contact_id, body)
     * @return array<string, mixed>
     */
    public function createNote(array $data): array
    {
        return $this->request('POST', '/notes', $data);
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
