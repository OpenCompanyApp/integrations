<?php

namespace OpenCompany\Integrations\Mattermost;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Mattermost REST API v4.
 *
 * Handles bearer-token authentication, JSON request dispatch, Mattermost error
 * normalization, and endpoint helpers used by individual tools.
 */
class MattermostService
{
    /**
     * @param  string  $accessToken  Mattermost personal access token or bot token.
     * @param  string  $baseUrl  Mattermost server base URL without trailing slash.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://mattermost.example.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Execute a raw GET request against the Mattermost API.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Execute a raw POST request against the Mattermost API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw PUT request against the Mattermost API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw PATCH request against the Mattermost API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw DELETE request against the Mattermost API.
     *
     * @param  array<string, mixed>  $payload  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * List channels the current user belongs to.
     *
     * @param  int  $page     Page number (0-indexed).
     * @param  int  $perPage  Number of channels per page.
     * @return array<string, mixed>
     */
    public function listChannels(int $page = 0, int $perPage = 60): array
    {
        return $this->request('GET', '/api/v4/channels', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a channel by ID.
     *
     * @param  string  $channelId  The channel ID.
     * @return array<string, mixed>
     */
    public function getChannel(string $channelId): array
    {
        return $this->request('GET', '/api/v4/channels/' . urlencode($channelId));
    }

    /**
     * Create a post (message) in a channel.
     *
     * @param  string  $channelId  The channel to post in.
     * @param  string  $message    The message body.
     * @return array<string, mixed>
     */
    public function createPost(string $channelId, string $message): array
    {
        return $this->request('POST', '/api/v4/posts', [
            'channel_id' => $channelId,
            'message' => $message,
        ]);
    }

    /**
     * List posts in a channel.
     *
     * @param  string  $channelId  The channel ID.
     * @param  int     $page       Page number (0-indexed).
     * @param  int     $perPage    Number of posts per page.
     * @return array<string, mixed>
     */
    public function listPosts(string $channelId, int $page = 0, int $perPage = 60): array
    {
        return $this->request('GET', '/api/v4/channels/' . urlencode($channelId) . '/posts', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a single post by ID.
     *
     * @param  string  $postId  The post ID.
     * @return array<string, mixed>
     */
    public function getPost(string $postId): array
    {
        return $this->request('GET', '/api/v4/posts/' . urlencode($postId));
    }

    /**
     * List all teams the current user belongs to.
     *
     * @param  int  $page     Page number (0-indexed).
     * @param  int  $perPage  Number of teams per page.
     * @return array<string, mixed>
     */
    public function listTeams(int $page = 0, int $perPage = 60): array
    {
        return $this->request('GET', '/api/v4/teams', [
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
        return $this->request('GET', '/api/v4/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path (e.g. /api/v4/channels).
     * @param  array<string, mixed>  $data    Query params or JSON body.
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
     * Normalize a raw path to a Mattermost API v4 path.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '') {
            throw new \RuntimeException('Mattermost API path is required.');
        }

        if (str_starts_with($path, $this->baseUrl)) {
            $path = substr($path, strlen($this->baseUrl));
        }

        $path = '/' . ltrim($path, '/');

        return str_starts_with($path, '/api/v4/') ? $path : '/api/v4' . $path;
    }

    /**
     * Make a raw HTTP request to the Mattermost API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data    Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Mattermost access token is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Mattermost API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Mattermost API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Mattermost API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Mattermost API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mattermost API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mattermost API: {$e->getMessage()}");
        }
    }
}
