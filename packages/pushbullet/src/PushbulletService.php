<?php

namespace OpenCompany\Integrations\Pushbullet;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Pushbullet API.
 *
 * Handles access-token authentication and exposes pushes, devices, chats, subscriptions, channels, ephemerals, and uploads.
 */
class PushbulletService
{
    /**
     * @param  string  $accessToken  Pushbullet access token.
     * @param  string  $baseUrl  Pushbullet API base URL.
     */
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
     * @param  array<string, mixed>  $params  Query parameters (limit, cursor, active, modified_after).
     * @return array<string, mixed>
     */
    public function listPushes(array $params = []): array
    {
        if (isset($params['limit'])) {
            $params['limit'] = min((int) $params['limit'], 500);
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
     * Update a push, most commonly to mark it dismissed.
     *
     * @param  string  $pushIden  Push identifier.
     * @param  array<string, mixed>  $updates  Push fields to update.
     * @return array<string, mixed>
     */
    public function updatePush(string $pushIden, array $updates): array
    {
        return $this->request('POST', '/pushes/' . urlencode($pushIden), $updates);
    }

    /**
     * Delete all pushes belonging to the current user.
     */
    public function deleteAllPushes(): void
    {
        $this->request('DELETE', '/pushes');
    }

    /**
     * List devices registered with the current user's Pushbullet account.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, cursor, active, modified_after).
     * @return array<string, mixed>
     */
    public function listDevices(array $params = []): array
    {
        return $this->request('GET', '/devices', $params);
    }

    /**
     * Create a Pushbullet device.
     *
     * @param  array<string, mixed>  $device  Device fields.
     * @return array<string, mixed>
     */
    public function createDevice(array $device): array
    {
        return $this->request('POST', '/devices', $device);
    }

    /**
     * Update a Pushbullet device.
     *
     * @param  string  $deviceIden  Device identifier.
     * @param  array<string, mixed>  $updates  Device fields to update.
     * @return array<string, mixed>
     */
    public function updateDevice(string $deviceIden, array $updates): array
    {
        return $this->request('POST', '/devices/' . urlencode($deviceIden), $updates);
    }

    /**
     * Delete a Pushbullet device.
     *
     * @param  string  $deviceIden  Device identifier.
     */
    public function deleteDevice(string $deviceIden): void
    {
        $this->request('DELETE', '/devices/' . urlencode($deviceIden));
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
     * List chats belonging to the current user.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, cursor, active, modified_after).
     * @return array<string, mixed>
     */
    public function listChats(array $params = []): array
    {
        return $this->request('GET', '/chats', $params);
    }

    /**
     * Create a chat with another user or email address.
     *
     * @param  string  $email  Email address for the chat participant.
     * @return array<string, mixed>
     */
    public function createChat(string $email): array
    {
        return $this->request('POST', '/chats', ['email' => $email]);
    }

    /**
     * Update a chat, usually to mute or unmute it.
     *
     * @param  string  $chatIden  Chat identifier.
     * @param  array<string, mixed>  $updates  Chat fields to update.
     * @return array<string, mixed>
     */
    public function updateChat(string $chatIden, array $updates): array
    {
        return $this->request('POST', '/chats/' . urlencode($chatIden), $updates);
    }

    /**
     * Delete a chat.
     *
     * @param  string  $chatIden  Chat identifier.
     */
    public function deleteChat(string $chatIden): void
    {
        $this->request('DELETE', '/chats/' . urlencode($chatIden));
    }

    /**
     * List channel subscriptions belonging to the current user.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, cursor, active, modified_after).
     * @return array<string, mixed>
     */
    public function listSubscriptions(array $params = []): array
    {
        return $this->request('GET', '/subscriptions', $params);
    }

    /**
     * Subscribe to a channel by tag.
     *
     * @param  string  $channelTag  Channel tag.
     * @return array<string, mixed>
     */
    public function createSubscription(string $channelTag): array
    {
        return $this->request('POST', '/subscriptions', ['channel_tag' => $channelTag]);
    }

    /**
     * Update a channel subscription.
     *
     * @param  string  $subscriptionIden  Subscription identifier.
     * @param  array<string, mixed>  $updates  Subscription fields to update.
     * @return array<string, mixed>
     */
    public function updateSubscription(string $subscriptionIden, array $updates): array
    {
        return $this->request('POST', '/subscriptions/' . urlencode($subscriptionIden), $updates);
    }

    /**
     * Delete a channel subscription.
     *
     * @param  string  $subscriptionIden  Subscription identifier.
     */
    public function deleteSubscription(string $subscriptionIden): void
    {
        $this->request('DELETE', '/subscriptions/' . urlencode($subscriptionIden));
    }

    /**
     * Get public information about a channel.
     *
     * @param  string  $tag  Channel tag.
     * @param  bool|null  $noRecentPushes  Whether to omit recent pushes.
     * @return array<string, mixed>
     */
    public function getChannelInfo(string $tag, ?bool $noRecentPushes = null): array
    {
        $params = ['tag' => $tag];
        if ($noRecentPushes !== null) {
            $params['no_recent_pushes'] = $noRecentPushes;
        }

        return $this->request('GET', '/channel-info', $params);
    }

    /**
     * Create a Pushbullet channel.
     *
     * @param  array<string, mixed>  $channel  Channel fields.
     * @return array<string, mixed>
     */
    public function createChannel(array $channel): array
    {
        return $this->request('POST', '/channels', $channel);
    }

    /**
     * Push an ephemeral event such as a clip or notification dismissal.
     *
     * @param  array<string, mixed>  $payload  Ephemeral payload.
     * @return array<string, mixed>
     */
    public function pushEphemeral(array $payload): array
    {
        return $this->request('POST', '/ephemerals', $payload);
    }

    /**
     * Request an upload URL for a file push.
     *
     * @param  string  $fileName  Name of the file.
     * @param  string  $fileType  MIME type of the file.
     * @return array<string, mixed>
     */
    public function requestUpload(string $fileName, string $fileType): array
    {
        return $this->request('POST', '/upload-request', [
            'file_name' => $fileName,
            'file_type' => $fileType,
        ]);
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

        if ($response->body() === '') {
            return [];
        }

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
