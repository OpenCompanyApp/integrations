<?php

namespace OpenCompany\Integrations\Discord;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Discord REST API (v10) covering channels, messages, guilds, and users.
 *
 * Wraps HTTP calls with Bearer token authentication, request routing, and error reporting.
 */
class DiscordService
{
    /**
     * @param  string  $accessToken  Discord access token
     * @param  string  $baseUrl      Discord API base URL (default: https://discord.com/api/v10)
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://discord.com/api/v10',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Channels ────────────────────────────────────────────

    /**
     * List channels in a guild.
     *
     * @param  string  $guildId  Snowflake guild ID
     * @return array<string, mixed>
     */
    public function listChannels(string $guildId): array
    {
        return $this->request('GET', "/guilds/{$guildId}/channels");
    }

    /**
     * Get a channel by ID.
     *
     * @param  string  $channelId  Snowflake channel ID
     * @return array<string, mixed>
     */
    public function getChannel(string $channelId): array
    {
        return $this->request('GET', "/channels/{$channelId}");
    }

    // ── Messages ────────────────────────────────────────────

    /**
     * Send a message to a channel.
     *
     * @param  string  $channelId  Snowflake channel ID
     * @param  array<string, mixed>  $data  Message payload (content, embeds, tts)
     * @return array<string, mixed>
     */
    public function sendMessage(string $channelId, array $data): array
    {
        return $this->request('POST', "/channels/{$channelId}/messages", $data);
    }

    /**
     * Get messages from a channel.
     *
     * @param  string  $channelId  Snowflake channel ID
     * @param  array<string, mixed>  $params  Query params (limit, before, after)
     * @return array<string, mixed>
     */
    public function listMessages(string $channelId, array $params = []): array
    {
        return $this->request('GET', "/channels/{$channelId}/messages", $params);
    }

    // ── Guilds ──────────────────────────────────────────────

    /**
     * List guilds the current user is in.
     *
     * @param  array<string, mixed>  $params  Query params (limit, before, after)
     * @return array<string, mixed>
     */
    public function listGuilds(array $params = []): array
    {
        return $this->request('GET', '/users/@me/guilds', $params);
    }

    /**
     * Get a guild by ID.
     *
     * @param  string  $guildId  Snowflake guild ID
     * @return array<string, mixed>
     */
    public function getGuild(string $guildId): array
    {
        return $this->request('GET', "/guilds/{$guildId}");
    }

    // ── Users ───────────────────────────────────────────────

    /**
     * Get the current user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/@me');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to Discord.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     *
     * @throws \RuntimeException  On connection failure, rate limit (429), or API error
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Discord access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            // Handle rate limiting
            if ($response->status() === 429) {
                $retryAfter = $response->header('Retry-After');
                Log::warning("Discord API rate limited: {$method} {$path}", [
                    'retry_after' => $retryAfter,
                ]);
                throw new \RuntimeException('Discord API rate limited. Retry after: ' . ($retryAfter ?? 'unknown') . ' seconds.');
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $response->body();

                Log::error("Discord API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Discord API error ({$response->status()}): {$error}");
            }

            // Some Discord endpoints return 204 No Content
            if ($response->status() === 204) {
                return [];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Discord API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Discord API: {$e->getMessage()}");
        }
    }
}
