<?php

namespace OpenCompany\Integrations\Discord;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Discord REST API (v10).
 *
 * Wraps HTTP calls with configurable Bearer/Bot token authentication, request
 * routing, rate-limit errors, and JSON response parsing.
 */
class DiscordService
{
    /**
     * @param  string  $accessToken  Discord access token or bot token
     * @param  string  $baseUrl      Discord API base URL (default: https://discord.com/api/v10)
     * @param  string  $authScheme   Authorization scheme, usually Bearer or Bot
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://discord.com/api/v10',
        private string $authScheme = 'Bearer',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->authScheme = $this->normalizeAuthScheme($this->authScheme);
    }

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    /**
     * Execute a raw GET request against the Discord API.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Execute a raw POST request against the Discord API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw PATCH request against the Discord API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw PUT request against the Discord API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw DELETE request against the Discord API.
     *
     * @param  array<string, mixed>  $payload  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    // Channels

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

    // Messages

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

    // Guilds

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

    // Users

    /**
     * Get the current user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/@me');
    }

    /**
     * Normalize a raw path to a Discord API v10 path.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '') {
            throw new \RuntimeException('Discord API path is required.');
        }

        if (str_starts_with($path, $this->baseUrl)) {
            $path = substr($path, strlen($this->baseUrl));
        }

        return '/' . ltrim($path, '/');
    }

    /**
     * Normalize allowed Discord authorization schemes.
     */
    private function normalizeAuthScheme(string $scheme): string
    {
        $scheme = strtolower(trim($scheme));

        return match ($scheme) {
            'bot' => 'Bot',
            default => 'Bearer',
        };
    }

    // HTTP

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
                'Authorization' => $this->authScheme . ' ' . $this->accessToken,
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
