<?php

namespace OpenCompany\Integrations\Lark;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LarkService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://open.larksuite.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Lark integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List chats the current user belongs to.
     *
     * @param  int  $pageSize   Number of chats per page (max 50, default 20).
     * @param  string|null  $pageToken  Cursor from a previous response for pagination.
     * @return array<string, mixed>
     */
    public function listChats(int $pageSize = 20, ?string $pageToken = null): array
    {
        $params = ['page_size' => $pageSize];
        if ($pageToken) {
            $params['page_token'] = $pageToken;
        }

        return $this->request('GET', '/open-apis/chat/v5/chats', $params);
    }

    /**
     * Get detailed information about a specific chat.
     *
     * @param  string  $chatId  The chat ID.
     * @return array<string, mixed>
     */
    public function getChat(string $chatId): array
    {
        return $this->request('GET', '/open-apis/chat/v5/chats/' . urlencode($chatId));
    }

    /**
     * Create a new group chat.
     *
     * @param  string  $chatId  Optional chat ID for the new chat.
     * @param  string  $name  The name of the new chat.
     * @return array<string, mixed>
     */
    public function createChat(string $chatId, string $name): array
    {
        return $this->request('POST', '/open-apis/chat/v5/chats', [
            'chat_id' => $chatId,
            'name' => $name,
        ]);
    }

    /**
     * List messages in a specific chat.
     *
     * @param  string  $chatId  The chat ID.
     * @param  int  $pageSize  Number of messages per page (max 50, default 20).
     * @param  string|null  $pageToken  Cursor from a previous response for pagination.
     * @return array<string, mixed>
     */
    public function listMessages(string $chatId, int $pageSize = 20, ?string $pageToken = null): array
    {
        $params = ['page_size' => $pageSize];
        if ($pageToken) {
            $params['page_token'] = $pageToken;
        }

        return $this->request('GET', '/open-apis/chat/v5/chats/' . urlencode($chatId) . '/messages', $params);
    }

    /**
     * Send a message to a specific chat.
     *
     * @param  string  $chatId  The chat ID to send the message to.
     * @param  string  $content  The message content (JSON-encoded for rich messages).
     * @param  string  $msgType  The message type (e.g., "text", "post", "image").
     * @return array<string, mixed>
     */
    public function sendMessage(string $chatId, string $content, string $msgType = 'text'): array
    {
        return $this->request('POST', '/open-apis/chat/v5/chats/' . urlencode($chatId) . '/messages', [
            'content' => $content,
            'msg_type' => $msgType,
        ]);
    }

    /**
     * List members of a specific chat.
     *
     * @param  string  $chatId  The chat ID.
     * @param  int  $pageSize  Number of members per page (max 50, default 20).
     * @param  string|null  $pageToken  Cursor from a previous response for pagination.
     * @return array<string, mixed>
     */
    public function listMembers(string $chatId, int $pageSize = 20, ?string $pageToken = null): array
    {
        $params = ['page_size' => $pageSize];
        if ($pageToken) {
            $params['page_token'] = $pageToken;
        }

        return $this->request('GET', '/open-apis/chat/v5/chats/' . urlencode($chatId) . '/members', $params);
    }

    /**
     * Get information about the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/open-apis/auth/v3/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters or body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Lark Open API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters or body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Lark access token is not configured.');
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
                    Log::warning("Lark API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Lark API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not be accessible with the current token.");
                }

                $json = $response->json();
                $error = $json['msg'] ?? $json['error'] ?? $body;
                Log::error("Lark API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Lark API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Lark API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Lark API: {$e->getMessage()}");
        }
    }
}
