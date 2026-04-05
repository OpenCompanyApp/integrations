<?php

namespace OpenCompany\Integrations\Mattermost;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Mattermost REST API (v4).
 *
 * Wraps HTTP calls to Mattermost's REST endpoints for posts, channels,
 * teams, users, and file uploads using a Personal Access Token or Bot Token.
 */
class MattermostService
{
    /**
     * @param  string  $apiToken  Mattermost Personal Access Token or Bot Token
     * @param  string  $baseUrl   Mattermost API base URL (e.g. https://mattermost.example.com/api/v4)
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiToken) && ! empty($this->baseUrl);
    }

    // ── Connection Test ─────────────────────────────────────

    /**
     * Test the API token by fetching the current user.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Posts ───────────────────────────────────────────────

    /**
     * Create a new post in a channel.
     *
     * @param  array<string, mixed>  $data  Post payload (channel_id, message, file_ids, props, root_id)
     * @return array<string, mixed>
     */
    public function createPost(array $data): array
    {
        return $this->request('POST', '/posts', $data);
    }

    /**
     * Get a post by ID.
     *
     * @param  string  $postId  The post ID
     * @return array<string, mixed>
     */
    public function getPost(string $postId): array
    {
        return $this->request('GET', "/posts/{$postId}");
    }

    /**
     * Delete a post by ID.
     *
     * @param  string  $postId  The post ID
     * @return array<string, mixed>
     */
    public function deletePost(string $postId): array
    {
        return $this->request('DELETE', "/posts/{$postId}");
    }

    /**
     * List posts in a channel.
     *
     * @param  string  $channelId  The channel ID
     * @param  array<string, mixed>  $params  Query params (page, per_page)
     * @return array<string, mixed>
     */
    public function listPosts(string $channelId, array $params = []): array
    {
        return $this->request('GET', "/channels/{$channelId}/posts", $params);
    }

    // ── Channels ────────────────────────────────────────────

    /**
     * Create a new channel.
     *
     * @param  array<string, mixed>  $data  Channel payload (team_id, name, display_name, type, purpose)
     * @return array<string, mixed>
     */
    public function createChannel(array $data): array
    {
        return $this->request('POST', '/channels', $data);
    }

    /**
     * List channels in a team.
     *
     * @param  string  $teamId  The team ID
     * @param  array<string, mixed>  $params  Query params (page, per_page)
     * @return array<string, mixed>
     */
    public function listChannels(string $teamId, array $params = []): array
    {
        return $this->request('GET', "/teams/{$teamId}/channels", $params);
    }

    /**
     * Get a channel by ID.
     *
     * @param  string  $channelId  The channel ID
     * @return array<string, mixed>
     */
    public function getChannel(string $channelId): array
    {
        return $this->request('GET', "/channels/{$channelId}");
    }

    // ── Teams ───────────────────────────────────────────────

    /**
     * List all teams.
     *
     * @param  array<string, mixed>  $params  Query params (page, per_page)
     * @return array<string, mixed>
     */
    public function listTeams(array $params = []): array
    {
        return $this->request('GET', '/teams', $params);
    }

    /**
     * Get a team by ID.
     *
     * @param  string  $teamId  The team ID
     * @return array<string, mixed>
     */
    public function getTeam(string $teamId): array
    {
        return $this->request('GET', "/teams/{$teamId}");
    }

    // ── Users ───────────────────────────────────────────────

    /**
     * List users.
     *
     * @param  array<string, mixed>  $params  Query params (page, per_page, in_team_id)
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a user by ID.
     *
     * @param  string  $userId  The user ID
     * @return array<string, mixed>
     */
    public function getUser(string $userId): array
    {
        return $this->request('GET', "/users/{$userId}");
    }

    // ── Files ───────────────────────────────────────────────

    /**
     * Upload a file to Mattermost via multipart form data.
     *
     * @param  string  $channelId   The channel ID to associate the file with
     * @param  string  $filename    The name of the file
     * @param  string  $fileContent The raw file contents
     * @return array<string, mixed>
     */
    public function uploadFile(string $channelId, string $filename, string $fileContent): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Mattermost API token and base URL are not configured.');
        }

        $url = rtrim($this->baseUrl, '/') . '/files';

        try {
            $response = Http::timeout(60)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiToken,
                ])
                ->attach('files', $fileContent, $filename)
                ->post($url, [
                    'channel_id' => $channelId,
                ]);

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $response->body();

                Log::error('Mattermost API error: POST /files', [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Mattermost API error ({$response->status()}): {$error}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Mattermost API connection error: POST /files', [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mattermost API: {$e->getMessage()}");
        }
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Mattermost.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, PATCH, DELETE)
     * @param  string  $path    API endpoint path (e.g. /posts, /channels/{id})
     * @param  array<string, mixed>  $data  Request body or query params
     * @return array<string, mixed>
     *
     * @throws \RuntimeException  On connection failure or API error
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Mattermost API token and base URL are not configured.');
        }

        $url = rtrim($this->baseUrl, '/') . $path;

        try {
            $http = Http::timeout(30)->withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ]);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 429) {
                $retryAfter = $response->header('Retry-After');
                Log::warning("Mattermost API rate limited: {$method} {$path}", [
                    'retry_after' => $retryAfter,
                ]);
                throw new \RuntimeException('Mattermost API rate limited. Retry after: ' . ($retryAfter ?? 'unknown') . ' seconds.');
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $response->body();

                Log::error("Mattermost API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Mattermost API error ({$response->status()}): {$error}");
            }

            if ($response->status() === 204) {
                return [];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mattermost API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mattermost API: {$e->getMessage()}");
        }
    }
}
