<?php

namespace OpenCompany\Integrations\Front;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FrontService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api2.frontapp.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the authenticated user's profile.
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
     * List contacts with optional filters.
     *
     * @param  int|null  $page   Page number (1-based).
     * @param  int|null  $limit  Results per page (max 100).
     * @param  string|null  $q  Search query.
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
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/contacts/' . urlencode($id));
    }

    /**
     * Make an API request and return parsed JSON.
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
     * Make a raw HTTP request to the Front API.
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
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
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
