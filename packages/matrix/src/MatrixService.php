<?php

namespace OpenCompany\Integrations\Matrix;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MatrixService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://matrix.org',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the authenticated user's information.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/_matrix/client/v3/account/whoami');
    }

    /**
     * List rooms the user has joined.
     */
    public function listRooms(int $limit = 50, ?string $from = null): array
    {
        $params = ['limit' => $limit];
        if ($from) {
            $params['from'] = $from;
        }

        return $this->request('GET', '/_matrix/client/v3/rooms', $params);
    }

    /**
     * Get details of a specific room.
     */
    public function getRoom(string $roomId): array
    {
        return $this->request('GET', '/_matrix/client/v3/rooms/' . urlencode($roomId));
    }

    /**
     * Create a new room.
     */
    public function createRoom(array $params): array
    {
        return $this->request('POST', '/_matrix/client/v3/rooms', $params);
    }

    /**
     * Send a message to a room.
     */
    public function sendMessage(string $roomId, string $txnId, string $msgtype, string $body): array
    {
        return $this->request('PUT', '/_matrix/client/v3/rooms/' . urlencode($roomId) . '/send/m.room.message/' . urlencode($txnId), [
            'msgtype' => $msgtype,
            'body' => $body,
        ]);
    }

    /**
     * List members of a room.
     */
    public function listMembers(string $roomId, int $limit = 100): array
    {
        return $this->request('GET', '/_matrix/client/v3/rooms/' . urlencode($roomId) . '/members', [
            'limit' => $limit,
        ]);
    }

    /**
     * Get a user's profile.
     */
    public function getProfile(string $userId): array
    {
        return $this->request('GET', '/_matrix/client/v3/profile/' . urlencode($userId));
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Matrix Client-Server API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Matrix access token is not configured.');
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
                    Log::warning("Matrix API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Matrix API endpoint not available (HTTP {$response->status()}). Check the homeserver URL.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Matrix API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Matrix API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Matrix API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Matrix homeserver: {$e->getMessage()}");
        }
    }
}
