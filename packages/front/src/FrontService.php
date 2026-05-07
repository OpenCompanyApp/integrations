<?php

namespace OpenCompany\Integrations\Front;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Front Core API.
 *
 * Handles bearer-token authentication, JSON request dispatch, path
 * normalization, and focused helpers used by Front tools.
 */
class FrontService
{
    /**
     * Create a new Front service instance.
     *
     * @param  string  $accessToken  Front API token or OAuth access token.
     * @param  string  $baseUrl  Base URL for the Front Core API.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api2.frontapp.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with a token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Execute a raw GET request against the Front API.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Execute a raw POST request against the Front API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw PATCH request against the Front API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw PUT request against the Front API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw DELETE request against the Front API.
     *
     * @param  array<string, mixed>  $payload  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Get the authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * List conversations with optional filters.
     *
     * @param  int|null  $page   Page number (1-based).
     * @param  int|null  $limit  Results per page (max 100).
     * @param  string|null  $status  Filter by status: open, archived, assigned, unassigned, starred, snoozed.
     * @param  string|null  $q  Search query.
     * @return array<string, mixed>
     */
    public function listConversations(?int $page = null, ?int $limit = null, ?string $status = null, ?string $q = null): array
    {
        $params = array_filter([
            'page' => $page,
            'limit' => $limit,
            'status' => $status,
            'q' => $q,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/conversations', $params);
    }

    /**
     * Get a single conversation by ID.
     *
     * @return array<string, mixed>
     */
    public function getConversation(string $id): array
    {
        return $this->request('GET', '/conversations/' . urlencode($id));
    }

    /**
     * List messages in a conversation.
     *
     * @param  string  $id     Conversation ID.
     * @param  int|null  $limit  Results per page (max 100).
     * @param  int|null  $page   Page number (1-based).
     * @return array<string, mixed>
     */
    public function listMessages(string $id, ?int $limit = null, ?int $page = null): array
    {
        $params = array_filter([
            'limit' => $limit,
            'page' => $page,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/conversations/' . urlencode($id) . '/messages', $params);
    }

    /**
     * Send a message (reply) to a conversation.
     *
     * @param  string  $id     Conversation ID.
     * @param  string  $body   HTML body of the message.
     * @param  string|null  $text   Plain-text body of the message.
     * @param  array|null  $to     Array of recipient objects: [["handle" => "email@example.com"]].
     * @param  array|null  $cc     Array of CC recipient objects: [["handle" => "email@example.com"]].
     * @return array<string, mixed>
     */
    public function sendMessage(string $id, string $body, ?string $text = null, ?array $to = null, ?array $cc = null): array
    {
        $data = array_filter([
            'body' => $body,
            'text' => $text,
            'to' => $to,
            'cc' => $cc,
        ], fn ($value) => $value !== null);

        return $this->request('POST', '/conversations/' . urlencode($id) . '/messages', $data);
    }

    /**
     * Send a new message through a Front channel.
     *
     * @param  array<string, mixed>  $data  Message payload.
     * @return array<string, mixed>
     */
    public function createMessage(string $channelId, array $data): array
    {
        return $this->request('POST', '/channels/' . urlencode($channelId) . '/messages', $data);
    }

    /**
     * Get a single message by ID.
     *
     * @return array<string, mixed>
     */
    public function getMessage(string $id): array
    {
        return $this->request('GET', '/messages/' . urlencode($id));
    }

    /**
     * List inboxes accessible by the token.
     *
     * @param  array<string, mixed>  $params  Pagination or sort query parameters.
     * @return array<string, mixed>
     */
    public function listInboxes(array $params = []): array
    {
        return $this->request('GET', '/inboxes', array_filter($params, fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Get a single inbox by ID.
     *
     * @return array<string, mixed>
     */
    public function getInbox(string $id): array
    {
        return $this->request('GET', '/inboxes/' . urlencode($id));
    }

    /**
     * List contacts with optional filters.
     *
     * @param  int|null  $page   Page number (1-based).
     * @param  int|null  $limit  Results per page (max 100).
     * @param  string|null  $q  Search query.
     * @return array<string, mixed>
     */
    public function listContacts(?int $page = null, ?int $limit = null, ?string $q = null): array
    {
        $params = array_filter([
            'page' => $page,
            'limit' => $limit,
            'q' => $q,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/contacts/' . urlencode($id));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
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
     * Normalize a user-supplied API path to a relative Front path.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '') {
            throw new \RuntimeException('Front API path is required.');
        }

        if (str_starts_with($path, $this->baseUrl)) {
            $path = substr($path, strlen($this->baseUrl));
        }

        return '/' . ltrim($path, '/');
    }

    /**
     * Make a raw HTTP request to the Front API.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return \Illuminate\Http\Client\Response
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Front access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

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
                    Log::warning("Front API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Front API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Front API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Front API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Front API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Front API: {$e->getMessage()}");
        }
    }
}
