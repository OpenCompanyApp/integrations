<?php

namespace OpenCompany\Integrations\Freshchat;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FreshchatService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.freshchat.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List conversations with optional filters.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page.
     * @param  string|null  $status   Filter by conversation status (e.g., "new", "open", "resolved").
     * @param  string|null  $inboxId  Filter by inbox ID.
     * @return array<string, mixed>
     */
    public function listConversations(int $page = 1, int $perPage = 50, ?string $status = null, ?string $inboxId = null): array
    {
        $body = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($status !== null) {
            $body['status'] = $status;
        }

        if ($inboxId !== null) {
            $body['inbox_id'] = $inboxId;
        }

        return $this->request('POST', '/api/v2/conversations', $body);
    }

    /**
     * Get a single conversation by ID.
     *
     * @param  string  $id  The conversation ID.
     * @return array<string, mixed>
     */
    public function getConversation(string $id): array
    {
        return $this->request('GET', '/api/v2/conversations/' . urlencode($id));
    }

    /**
     * Create a new conversation.
     *
     * @param  string  $userId          The user ID to associate with the conversation.
     * @param  string  $initialMessage  The first message in the conversation.
     * @param  string|null  $channelId  Optional channel ID.
     * @return array<string, mixed>
     */
    public function createConversation(string $userId, string $initialMessage, ?string $channelId = null): array
    {
        $body = [
            'user_id' => $userId,
            'initial_message' => $initialMessage,
        ];

        if ($channelId !== null) {
            $body['channel_id'] = $channelId;
        }

        return $this->request('POST', '/api/v2/conversations', $body);
    }

    /**
     * List agents with pagination.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page.
     * @return array<string, mixed>
     */
    public function listAgents(int $page = 1, int $perPage = 50): array
    {
        return $this->request('POST', '/api/v2/agents', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a single agent by ID.
     *
     * @param  string  $id  The agent ID.
     * @return array<string, mixed>
     */
    public function getAgent(string $id): array
    {
        return $this->request('GET', '/api/v2/agents/' . urlencode($id));
    }

    /**
     * List groups with pagination.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page.
     * @return array<string, mixed>
     */
    public function listGroups(int $page = 1, int $perPage = 50): array
    {
        return $this->request('POST', '/api/v2/groups', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v2/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Freshchat API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Freshchat access token is not configured.');
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
                    Log::warning("Freshchat API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Freshchat API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Freshchat API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Freshchat API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Freshchat API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Freshchat API: {$e->getMessage()}");
        }
    }
}
