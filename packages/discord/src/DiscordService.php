<?php

namespace OpenCompany\Integrations\Discord;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Discord Bot API (v10).
 *
 * Wraps HTTP calls to Discord's REST endpoints for messages, channels,
 * guilds, members, roles, reactions, users, and webhooks.
 */
class DiscordService
{
    private const BASE_URL = 'https://discord.com/api/v10';

    /**
     * @param  string  $botToken  Discord Bot Token
     */
    public function __construct(
        private string $botToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->botToken);
    }

    // ── Connection Test ─────────────────────────────────────

    /**
     * Test the bot token by fetching the current user.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/users/@me');
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
    public function getMessages(string $channelId, array $params = []): array
    {
        return $this->request('GET', "/channels/{$channelId}/messages", $params);
    }

    /**
     * Get a single message by ID.
     *
     * @param  string  $channelId   Snowflake channel ID
     * @param  string  $messageId   Snowflake message ID
     * @return array<string, mixed>
     */
    public function getMessage(string $channelId, string $messageId): array
    {
        return $this->request('GET', "/channels/{$channelId}/messages/{$messageId}");
    }

    /**
     * Delete a message by ID.
     *
     * @param  string  $channelId   Snowflake channel ID
     * @param  string  $messageId   Snowflake message ID
     * @return array<string, mixed>
     */
    public function deleteMessage(string $channelId, string $messageId): array
    {
        return $this->request('DELETE', "/channels/{$channelId}/messages/{$messageId}");
    }

    // ── Channels ────────────────────────────────────────────

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

    /**
     * Create a channel in a guild.
     *
     * @param  string  $guildId  Snowflake guild ID
     * @param  array<string, mixed>  $data  Channel payload (name, type, topic, parent_id)
     * @return array<string, mixed>
     */
    public function createChannel(string $guildId, array $data): array
    {
        return $this->request('POST', "/guilds/{$guildId}/channels", $data);
    }

    /**
     * Update a channel's properties.
     *
     * @param  string  $channelId  Snowflake channel ID
     * @param  array<string, mixed>  $data  Update payload (name, topic, rate_limit_per_user)
     * @return array<string, mixed>
     */
    public function updateChannel(string $channelId, array $data): array
    {
        return $this->request('PATCH', "/channels/{$channelId}", $data);
    }

    /**
     * List all channels in a guild.
     *
     * @param  string  $guildId  Snowflake guild ID
     * @return array<string, mixed>
     */
    public function listGuildChannels(string $guildId): array
    {
        return $this->request('GET', "/guilds/{$guildId}/channels");
    }

    // ── Guilds ──────────────────────────────────────────────

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

    /**
     * List members of a guild.
     *
     * @param  string  $guildId  Snowflake guild ID
     * @param  array<string, mixed>  $params  Query params (limit, after)
     * @return array<string, mixed>
     */
    public function listGuildMembers(string $guildId, array $params = []): array
    {
        return $this->request('GET', "/guilds/{$guildId}/members", $params);
    }

    /**
     * Add a role to a guild member.
     *
     * @param  string  $guildId  Snowflake guild ID
     * @param  string  $userId   Snowflake user ID
     * @param  string  $roleId   Snowflake role ID
     * @return array<string, mixed>
     */
    public function addMemberRole(string $guildId, string $userId, string $roleId): array
    {
        return $this->request('PUT', "/guilds/{$guildId}/members/{$userId}/roles/{$roleId}");
    }

    /**
     * Remove a role from a guild member.
     *
     * @param  string  $guildId  Snowflake guild ID
     * @param  string  $userId   Snowflake user ID
     * @param  string  $roleId   Snowflake role ID
     * @return array<string, mixed>
     */
    public function removeMemberRole(string $guildId, string $userId, string $roleId): array
    {
        return $this->request('DELETE', "/guilds/{$guildId}/members/{$userId}/roles/{$roleId}");
    }

    /**
     * List roles in a guild.
     *
     * @param  string  $guildId  Snowflake guild ID
     * @return array<string, mixed>
     */
    public function listGuildRoles(string $guildId): array
    {
        return $this->request('GET', "/guilds/{$guildId}/roles");
    }

    // ── Reactions ───────────────────────────────────────────

    /**
     * Add a reaction to a message.
     *
     * @param  string  $channelId  Snowflake channel ID
     * @param  string  $messageId  Snowflake message ID
     * @param  string  $emoji      URL-encoded emoji (e.g. "%F0%9F%91%8D" or "emoji_name:emoji_id")
     * @return array<string, mixed>
     */
    public function addReaction(string $channelId, string $messageId, string $emoji): array
    {
        return $this->request('PUT', "/channels/{$channelId}/messages/{$messageId}/reactions/{$emoji}/@me");
    }

    // ── Users ───────────────────────────────────────────────

    /**
     * Get a user by ID.
     *
     * @param  string  $userId  Snowflake user ID
     * @return array<string, mixed>
     */
    public function getUser(string $userId): array
    {
        return $this->request('GET', "/users/{$userId}");
    }

    /**
     * Get the current bot user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/@me');
    }

    // ── Guild Member Management ─────────────────────────────

    /**
     * Modify a guild member's properties.
     *
     * @param  string  $guildId  Snowflake guild ID
     * @param  string  $userId   Snowflake user ID
     * @param  array<string, mixed>  $data  Update payload (nick, roles, mute, deaf)
     * @return array<string, mixed>
     */
    public function modifyGuildMember(string $guildId, string $userId, array $data): array
    {
        return $this->request('PATCH', "/guilds/{$guildId}/members/{$userId}", $data);
    }

    // ── Webhooks ────────────────────────────────────────────

    /**
     * Execute a webhook (no bot auth required).
     *
     * @param  string  $webhookId     Snowflake webhook ID
     * @param  string  $webhookToken  Webhook token
     * @param  array<string, mixed>  $data  Payload (content, embeds, username, avatar_url)
     * @return array<string, mixed>
     */
    public function sendWebhook(string $webhookId, string $webhookToken, array $data): array
    {
        return $this->request('POST', "/webhooks/{$webhookId}/{$webhookToken}", $data, auth: false);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Discord.
     *
     * @param  array<string, mixed>  $data
     * @param  bool  $auth  Whether to include the bot authorization header
     * @return array<string, mixed>
     *
     * @throws \RuntimeException  On connection failure, rate limit (429), or API error
     */
    private function request(string $method, string $path, array $data = [], bool $auth = true): array
    {
        if ($auth && ! $this->botToken) {
            throw new \RuntimeException('Discord bot token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::timeout(30);

            if ($auth) {
                $http = $http->withHeaders([
                    'Authorization' => 'Bot ' . $this->botToken,
                    'Content-Type' => 'application/json',
                ]);
            } else {
                $http = $http->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
            }

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

            // Some Discord endpoints return 204 No Content (e.g., DELETE, PUT for roles)
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
