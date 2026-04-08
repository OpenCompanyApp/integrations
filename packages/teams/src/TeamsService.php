<?php

namespace OpenCompany\Integrations\Teams;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Microsoft Graph API (v1.0).
 *
 * Wraps HTTP calls to Microsoft Teams endpoints for teams, channels,
 * messages, and users via the Graph API.
 */
class TeamsService
{
    private const BASE_URL = 'https://graph.microsoft.com/v1.0';

    /**
     * @param  string  $accessToken  Microsoft Graph API access token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Connection Test ─────────────────────────────────────

    /**
     * Test the access token by fetching the current user.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/me');
    }

    // ── Teams ────────────────────────────────────────────────

    /**
     * List all teams the user is a member of.
     *
     * @param  array<string, mixed>  $params  Query params (top, skip)
     * @return array<string, mixed>
     */
    public function listTeams(array $params = []): array
    {
        return $this->request('GET', '/me/joinedTeams', $params);
    }

    /**
     * Get a team by ID.
     *
     * @param  string  $teamId  Team ID
     * @return array<string, mixed>
     */
    public function getTeam(string $teamId): array
    {
        return $this->request('GET', "/teams/{$teamId}");
    }

    // ── Channels ─────────────────────────────────────────────

    /**
     * List channels in a team.
     *
     * @param  string  $teamId  Team ID
     * @param  array<string, mixed>  $params  Query params (top, skip, filter)
     * @return array<string, mixed>
     */
    public function listChannels(string $teamId, array $params = []): array
    {
        return $this->request('GET', "/teams/{$teamId}/channels", $params);
    }

    /**
     * Get a channel by ID.
     *
     * @param  string  $teamId     Team ID
     * @param  string  $channelId  Channel ID
     * @return array<string, mixed>
     */
    public function getChannel(string $teamId, string $channelId): array
    {
        return $this->request('GET', "/teams/{$teamId}/channels/{$channelId}");
    }

    // ── Messages ─────────────────────────────────────────────

    /**
     * Send a message to a channel.
     *
     * @param  string  $teamId     Team ID
     * @param  string  $channelId  Channel ID
     * @param  array<string, mixed>  $data  Message payload (body)
     * @return array<string, mixed>
     */
    public function sendMessage(string $teamId, string $channelId, array $data): array
    {
        return $this->request('POST', "/teams/{$teamId}/channels/{$channelId}/messages", $data);
    }

    /**
     * List messages in a channel.
     *
     * @param  string  $teamId     Team ID
     * @param  string  $channelId  Channel ID
     * @param  array<string, mixed>  $params  Query params (top, skip)
     * @return array<string, mixed>
     */
    public function listMessages(string $teamId, string $channelId, array $params = []): array
    {
        return $this->request('GET', "/teams/{$teamId}/channels/{$channelId}/messages", $params);
    }

    // ── Users ────────────────────────────────────────────────

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Microsoft Graph.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Microsoft Teams access token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error']['message'] ?? $response->body();

                Log::error("Microsoft Graph API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Microsoft Graph API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Microsoft Graph API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Microsoft Graph API: {$e->getMessage()}");
        }
    }
}
