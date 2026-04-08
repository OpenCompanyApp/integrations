<?php

namespace OpenCompany\Integrations\Pushbullet;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PushbulletService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.pushbullet.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Pushbullet integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List pushes (notifications) for the current user.
     *
     * @param  int  $limit  Maximum number of pushes to return (default: 10, max: 500).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listPushes(int $limit = 10, ?string $cursor = null): array
    {
        $params = ['limit' => min($limit, 500)];
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/pushes', $params);
    }

    /**
     * Create a new push (notification).
     *
     * @param  string  $type  Push type: "note", "link", or "file".
     * @param  string  $title  The title of the push.
     * @param  string  $body  The body/message of the push.
     * @param  array<string, mixed>  $extra  Additional fields (e.g., "url" for link pushes, "device_iden" to target a device).
     * @return array<string, mixed>
     */
    public function createPush(string $type, string $title, string $body, array $extra = []): array
    {
        $data = array_merge($extra, [
            'type' => $type,
            'title' => $title,
            'body' => $body,
        ]);

        return $this->request('POST', '/pushes', $data);
    }

    /**
     * Delete a push by its ID.
     *
     * @param  string  $pushIden  The unique identifier (iden) of the push to delete.
     */
    public function deletePush(string $pushIden): void
    {
        $this->request('DELETE', '/pushes/' . urlencode($pushIden));
    }

    /**
     * List devices registered with the current user's Pushbullet account.
     *
     * @return array<string, mixed>
     */
    public function listDevices(): array
    {
        return $this->request('GET', '/devices');
    }

    /**
     * Get the current authenticated user's profile information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST/PUT/DELETE).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Pushbullet API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Pushbullet access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Access-Token' => $this->accessToken,
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
                $error = $response->json('error') ?? $response->body();
                Log::error("Pushbullet API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Pushbullet API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Pushbullet API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Pushbullet API: {$e->getMessage()}");
        }
    }
}
