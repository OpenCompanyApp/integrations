<?php

namespace OpenCompany\Integrations\Slack;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Slack Web API.
 *
 * Wraps HTTP calls to Slack's REST endpoints for messages, channels,
 * files, users, reactions, and usergroups.
 */
class SlackService
{
    private const BASE_URL = 'https://slack.com/api';

    /**
     * @param  string  $botToken  Slack Bot User OAuth Token (xoxb-...)
     */
    public function __construct(
        private string $botToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->botToken);
    }

    // ── Auth ────────────────────────────────────────────────

    /**
     * Test the bot token via auth.test.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('POST', '/auth.test');
    }

    // ── Messages ────────────────────────────────────────────

    /**
     * Send a message to a channel (chat.postMessage).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function sendMessage(array $data): array
    {
        return $this->request('POST', '/chat.postMessage', $data);
    }

    /**
     * Update an existing message (chat.update).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateMessage(array $data): array
    {
        return $this->request('POST', '/chat.update', $data);
    }

    /**
     * Delete a message (chat.delete).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function deleteMessage(array $data): array
    {
        return $this->request('POST', '/chat.delete', $data);
    }

    /**
     * Get a permalink for a message (chat.getPermalink).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getPermalink(array $params): array
    {
        return $this->request('GET', '/chat.getPermalink', $params);
    }

    /**
     * Search messages (search.messages).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function searchMessages(array $params): array
    {
        return $this->request('GET', '/search.messages', $params);
    }

    // ── Conversations ───────────────────────────────────────

    /**
     * Get channel history (conversations.history).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getChannelHistory(array $params): array
    {
        return $this->request('GET', '/conversations.history', $params);
    }

    /**
     * Get thread replies (conversations.replies).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getThreadReplies(array $params): array
    {
        return $this->request('GET', '/conversations.replies', $params);
    }

    /**
     * List conversations/channels (conversations.list).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listChannels(array $params): array
    {
        return $this->request('GET', '/conversations.list', $params);
    }

    /**
     * Get channel info (conversations.info).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getChannel(array $params): array
    {
        return $this->request('GET', '/conversations.info', $params);
    }

    /**
     * Create a channel (conversations.create).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createChannel(array $data): array
    {
        return $this->request('POST', '/conversations.create', $data);
    }

    /**
     * Set channel topic (conversations.setTopic).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function setTopic(array $data): array
    {
        return $this->request('POST', '/conversations.setTopic', $data);
    }

    /**
     * Set channel purpose (conversations.setPurpose).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function setPurpose(array $data): array
    {
        return $this->request('POST', '/conversations.setPurpose', $data);
    }

    /**
     * Archive a channel (conversations.archive).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function archiveChannel(array $data): array
    {
        return $this->request('POST', '/conversations.archive', $data);
    }

    /**
     * Invite users to a channel (conversations.invite).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function inviteToChannel(array $data): array
    {
        return $this->request('POST', '/conversations.invite', $data);
    }

    // ── Files ────────────────────────────────────────────────

    /**
     * Get an external upload URL (files.getUploadURLExternal).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getFileUploadURL(array $params): array
    {
        return $this->request('GET', '/files.getUploadURLExternal', $params);
    }

    /**
     * Upload a file to the external URL returned by getFileUploadURL.
     *
     * @param  string  $uploadUrl  The external upload URL from getFileUploadURL()
     * @param  string  $content    Raw file content to upload
     * @param  string  $filename   Filename with extension (e.g., "report.txt")
     *
     * @throws \RuntimeException  If the upload fails
     */
    public function uploadFileToURL(string $uploadUrl, string $content, string $filename): void
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->botToken,
        ])->attach('file', $content, $filename)
            ->post($uploadUrl);

        if (! $response->successful()) {
            Log::error('Slack file upload to external URL failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            throw new \RuntimeException('Failed to upload file to Slack external URL (' . $response->status() . ').');
        }
    }

    /**
     * Complete an external file upload (files.completeUploadExternal).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function completeUploadExternal(array $data): array
    {
        return $this->request('POST', '/files.completeUploadExternal', $data);
    }

    /**
     * List files (files.list).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listFiles(array $params): array
    {
        return $this->request('GET', '/files.list', $params);
    }

    /**
     * Get file info (files.info).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getFile(array $params): array
    {
        return $this->request('GET', '/files.info', $params);
    }

    // ── Users ────────────────────────────────────────────────

    /**
     * List users (users.list).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listUsers(array $params): array
    {
        return $this->request('GET', '/users.list', $params);
    }

    /**
     * Get user info (users.info).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getUser(array $params): array
    {
        return $this->request('GET', '/users.info', $params);
    }

    /**
     * Find a user by email (users.lookupByEmail).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function findUserByEmail(array $params): array
    {
        return $this->request('GET', '/users.lookupByEmail', $params);
    }

    // ── Reactions ────────────────────────────────────────────

    /**
     * Add a reaction (reactions.add).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function addReaction(array $data): array
    {
        return $this->request('POST', '/reactions.add', $data);
    }

    /**
     * Remove a reaction (reactions.remove).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function removeReaction(array $data): array
    {
        return $this->request('POST', '/reactions.remove', $data);
    }

    // ── Usergroups ──────────────────────────────────────────

    /**
     * List usergroups (usergroups.list).
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listUsergroups(array $params): array
    {
        return $this->request('GET', '/usergroups.list', $params);
    }

    /**
     * Update usergroup members (usergroups.users.update).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateUsergroupMembers(array $data): array
    {
        return $this->request('POST', '/usergroups.users.update', $data);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Slack.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->botToken) {
            throw new \RuntimeException('Slack bot token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->botToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $body = $response->json() ?? [];

            // Slack always returns HTTP 200 — check the "ok" field for API-level errors
            if (! ($body['ok'] ?? false)) {
                $error = $body['error'] ?? 'unknown_error';
                $needed = $body['needed'] ?? null;
                $provided = $body['provided'] ?? null;

                Log::error("Slack API error: {$method} {$path}", [
                    'error' => $error,
                    'needed' => $needed,
                    'provided' => $provided,
                ]);

                $msg = "Slack API error: {$error}";
                if ($needed) {
                    $msg .= " (needed: {$needed})";
                }

                throw new \RuntimeException($msg);
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Slack API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Slack API: {$e->getMessage()}");
        }
    }
}
