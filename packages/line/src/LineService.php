<?php

namespace OpenCompany\Integrations\Line;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LineService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.line.me/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Send a push message to a specific user or group.
     *
     * @param  string  $to  LINE user ID, group ID, or room ID
     * @param  array<int, array<string, mixed>>  $messages  Array of message objects
     * @param  bool  $notificationDisabled  Whether to disable push notification
     * @return array<string, mixed>
     */
    public function sendMessage(string $to, array $messages, bool $notificationDisabled = false): array
    {
        return $this->request('POST', '/bot/message/push', [
            'to' => $to,
            'messages' => $messages,
            'notificationDisabled' => $notificationDisabled,
        ]);
    }

    /**
     * Broadcast a message to all friends of the LINE Official Account.
     *
     * @param  array<int, array<string, mixed>>  $messages  Array of message objects
     * @param  bool  $notificationDisabled  Whether to disable push notification
     * @return array<string, mixed>
     */
    public function broadcastMessage(array $messages, bool $notificationDisabled = false): array
    {
        return $this->request('POST', '/bot/message/broadcast', [
            'messages' => $messages,
            'notificationDisabled' => $notificationDisabled,
        ]);
    }

    /**
     * Get the profile of a LINE user.
     *
     * @param  string  $userId  The LINE user ID
     * @return array<string, mixed>
     */
    public function getProfile(string $userId): array
    {
        return $this->request('GET', '/bot/profile/' . urlencode($userId));
    }

    /**
     * Get the profile of the LINE Official Account (bot info).
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/bot/info');
    }

    /**
     * List friends of the LINE Official Account.
     *
     * @param  int  $limit  Number of friends to retrieve (max 1000)
     * @param  string|null  $start  Continuation token for pagination
     * @return array<string, mixed>
     */
    public function listFriends(int $limit = 100, ?string $start = null): array
    {
        $params = ['limit' => min($limit, 1000)];
        if ($start !== null) {
            $params['start'] = $start;
        }

        return $this->request('GET', '/bot/friends', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Request data or query parameters
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
     * Make a raw HTTP request to the LINE Messaging API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Request data or query parameters
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('LINE Messaging API access token is not configured.');
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
                    Log::warning("LINE API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("LINE API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the access token may be invalid.");
                }

                $error = $response->json('message') ?? $body;
                Log::error("LINE API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("LINE API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("LINE API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to LINE API: {$e->getMessage()}");
        }
    }
}
