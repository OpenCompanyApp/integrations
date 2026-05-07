<?php

namespace OpenCompany\Integrations\Line;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the LINE Messaging API.
 *
 * Handles channel access token authentication, documented v2 endpoint routing, response parsing,
 * and error normalization for messaging, users, groups, webhooks, quotas, and rich menus.
 */
class LineService
{
    /**
     * @param  string  $accessToken  LINE Messaging API channel access token
     * @param  string  $baseUrl  LINE API host, with or without trailing /v2
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.line.me',
    ) {
        $this->baseUrl = preg_replace('#/v2$#', '', rtrim($this->baseUrl, '/')) ?: 'https://api.line.me';
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Send a reply message.
     *
     * @param  string  $replyToken  Reply token from webhook event
     * @param  array<int, array<string, mixed>>  $messages  Message objects
     * @param  bool  $notificationDisabled  Disable push notification
     * @return array<string, mixed>
     */
    public function replyMessage(string $replyToken, array $messages, bool $notificationDisabled = false): array
    {
        return $this->request('POST', '/v2/bot/message/reply', [
            'replyToken' => $replyToken,
            'messages' => $messages,
            'notificationDisabled' => $notificationDisabled,
        ]);
    }

    /**
     * Send a push message.
     *
     * @param  string  $to  User, group, or room ID
     * @param  array<int, array<string, mixed>>  $messages  Message objects
     * @param  bool  $notificationDisabled  Disable push notification
     * @param  string|null  $customAggregationUnits  Optional aggregation unit
     * @return array<string, mixed>
     */
    public function sendMessage(string $to, array $messages, bool $notificationDisabled = false, ?string $customAggregationUnits = null): array
    {
        return $this->request('POST', '/v2/bot/message/push', array_filter([
            'to' => $to,
            'messages' => $messages,
            'notificationDisabled' => $notificationDisabled,
            'customAggregationUnits' => $customAggregationUnits,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Send a multicast message.
     *
     * @param  array<int, string>  $to  User IDs
     * @param  array<int, array<string, mixed>>  $messages  Message objects
     * @param  bool  $notificationDisabled  Disable push notification
     * @return array<string, mixed>
     */
    public function multicastMessage(array $to, array $messages, bool $notificationDisabled = false): array
    {
        return $this->request('POST', '/v2/bot/message/multicast', [
            'to' => array_values($to),
            'messages' => $messages,
            'notificationDisabled' => $notificationDisabled,
        ]);
    }

    /**
     * Send a narrowcast message.
     *
     * @param  array<int, array<string, mixed>>  $messages  Message objects
     * @param  array<string, mixed>  $recipient  Recipient object
     * @param  array<string, mixed>  $filter  Demographic filter object
     * @param  bool  $notificationDisabled  Disable push notification
     * @return array<string, mixed>
     */
    public function narrowcastMessage(array $messages, array $recipient = [], array $filter = [], bool $notificationDisabled = false): array
    {
        return $this->request('POST', '/v2/bot/message/narrowcast', array_filter([
            'messages' => $messages,
            'recipient' => $recipient,
            'filter' => $filter,
            'notificationDisabled' => $notificationDisabled,
        ], static fn (mixed $value): bool => $value !== []));
    }

    /**
     * Get narrowcast progress.
     *
     * @param  string  $requestId  Narrowcast request ID
     * @return array<string, mixed>
     */
    public function getNarrowcastProgress(string $requestId): array
    {
        return $this->request('GET', '/v2/bot/message/progress/narrowcast', ['requestId' => $requestId]);
    }

    /**
     * Broadcast a message to all friends.
     *
     * @param  array<int, array<string, mixed>>  $messages  Message objects
     * @param  bool  $notificationDisabled  Disable push notification
     * @return array<string, mixed>
     */
    public function broadcastMessage(array $messages, bool $notificationDisabled = false): array
    {
        return $this->request('POST', '/v2/bot/message/broadcast', [
            'messages' => $messages,
            'notificationDisabled' => $notificationDisabled,
        ]);
    }

    /**
     * Mark a chat as read.
     *
     * @param  string  $chatId  User, group, or room ID
     * @return array<string, mixed>
     */
    public function markAsRead(string $chatId): array
    {
        return $this->request('POST', '/v2/bot/chat/markAsRead', ['chatId' => $chatId]);
    }

    /**
     * Start a loading animation.
     *
     * @param  string  $chatId  User, group, or room ID
     * @param  int|null  $loadingSeconds  Optional loading duration
     * @return array<string, mixed>
     */
    public function startLoadingAnimation(string $chatId, ?int $loadingSeconds = null): array
    {
        return $this->request('POST', '/v2/bot/chat/loading/start', array_filter([
            'chatId' => $chatId,
            'loadingSeconds' => $loadingSeconds,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Get the monthly message quota limit.
     *
     * @return array<string, mixed>
     */
    public function getMessageQuota(): array
    {
        return $this->request('GET', '/v2/bot/message/quota');
    }

    /**
     * Get message quota consumption.
     *
     * @return array<string, mixed>
     */
    public function getMessageQuotaConsumption(): array
    {
        return $this->request('GET', '/v2/bot/message/quota/consumption');
    }

    /**
     * Get message delivery count for a message class.
     *
     * @param  string  $type  reply, push, multicast, or broadcast
     * @param  string  $date  Date in yyyyMMdd format
     * @return array<string, mixed>
     */
    public function getMessageDelivery(string $type, string $date): array
    {
        $allowed = ['reply', 'push', 'multicast', 'broadcast'];
        if (! in_array($type, $allowed, true)) {
            throw new RuntimeException('Delivery type must be one of: ' . implode(', ', $allowed));
        }

        return $this->request('GET', "/v2/bot/message/delivery/{$type}", ['date' => $date]);
    }

    /**
     * Validate message objects for a target send endpoint.
     *
     * @param  string  $type  reply, push, multicast, narrowcast, or broadcast
     * @param  array<int, array<string, mixed>>  $messages  Message objects
     * @return array<string, mixed>
     */
    public function validateMessages(string $type, array $messages): array
    {
        $allowed = ['reply', 'push', 'multicast', 'narrowcast', 'broadcast'];
        if (! in_array($type, $allowed, true)) {
            throw new RuntimeException('Validation type must be one of: ' . implode(', ', $allowed));
        }

        return $this->request('POST', "/v2/bot/message/validate/{$type}", ['messages' => $messages]);
    }

    /**
     * Configure webhook endpoint URL.
     *
     * @param  string  $endpoint  Webhook endpoint URL
     * @return array<string, mixed>
     */
    public function setWebhookEndpoint(string $endpoint): array
    {
        return $this->request('PUT', '/v2/bot/channel/webhook/endpoint', ['endpoint' => $endpoint]);
    }

    /**
     * Get webhook endpoint settings.
     *
     * @return array<string, mixed>
     */
    public function getWebhookEndpoint(): array
    {
        return $this->request('GET', '/v2/bot/channel/webhook/endpoint');
    }

    /**
     * Test webhook endpoint delivery.
     *
     * @param  string|null  $endpoint  Optional endpoint override
     * @return array<string, mixed>
     */
    public function testWebhookEndpoint(?string $endpoint = null): array
    {
        return $this->request('POST', '/v2/bot/channel/webhook/test', $endpoint ? ['endpoint' => $endpoint] : []);
    }

    /**
     * Get a LINE user profile.
     *
     * @param  string  $userId  User ID
     * @return array<string, mixed>
     */
    public function getProfile(string $userId): array
    {
        return $this->request('GET', '/v2/bot/profile/' . rawurlencode($userId));
    }

    /**
     * Get IDs of users who added the official account as a friend.
     *
     * @param  int  $limit  Max 1000
     * @param  string|null  $start  Continuation token
     * @return array<string, mixed>
     */
    public function listFriends(int $limit = 100, ?string $start = null): array
    {
        return $this->request('GET', '/v2/bot/followers/ids', array_filter([
            'limit' => min($limit, 1000),
            'start' => $start,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Get bot information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/bot/info');
    }

    /**
     * Get group summary.
     *
     * @param  string  $groupId  Group ID
     * @return array<string, mixed>
     */
    public function getGroupSummary(string $groupId): array
    {
        return $this->request('GET', '/v2/bot/group/' . rawurlencode($groupId) . '/summary');
    }

    /**
     * Get group member count.
     *
     * @param  string  $groupId  Group ID
     * @return array<string, mixed>
     */
    public function getGroupMemberCount(string $groupId): array
    {
        return $this->request('GET', '/v2/bot/group/' . rawurlencode($groupId) . '/members/count');
    }

    /**
     * List group member user IDs.
     *
     * @param  string  $groupId  Group ID
     * @param  string|null  $start  Continuation token
     * @return array<string, mixed>
     */
    public function listGroupMemberIds(string $groupId, ?string $start = null): array
    {
        return $this->request('GET', '/v2/bot/group/' . rawurlencode($groupId) . '/members/ids', array_filter([
            'start' => $start,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Get group member profile.
     *
     * @param  string  $groupId  Group ID
     * @param  string  $userId  User ID
     * @return array<string, mixed>
     */
    public function getGroupMemberProfile(string $groupId, string $userId): array
    {
        return $this->request('GET', '/v2/bot/group/' . rawurlencode($groupId) . '/member/' . rawurlencode($userId));
    }

    /**
     * Leave a group chat.
     *
     * @param  string  $groupId  Group ID
     * @return array<string, mixed>
     */
    public function leaveGroup(string $groupId): array
    {
        return $this->request('POST', '/v2/bot/group/' . rawurlencode($groupId) . '/leave');
    }

    /**
     * Create a rich menu.
     *
     * @param  array<string, mixed>  $richMenu  Rich menu object
     * @return array<string, mixed>
     */
    public function createRichMenu(array $richMenu): array
    {
        return $this->request('POST', '/v2/bot/richmenu', $richMenu);
    }

    /**
     * Validate a rich menu object.
     *
     * @param  array<string, mixed>  $richMenu  Rich menu object
     * @return array<string, mixed>
     */
    public function validateRichMenu(array $richMenu): array
    {
        return $this->request('POST', '/v2/bot/richmenu/validate', $richMenu);
    }

    /**
     * List rich menus.
     *
     * @return array<string, mixed>
     */
    public function listRichMenus(): array
    {
        return $this->request('GET', '/v2/bot/richmenu/list');
    }

    /**
     * Get a rich menu.
     *
     * @param  string  $richMenuId  Rich menu ID
     * @return array<string, mixed>
     */
    public function getRichMenu(string $richMenuId): array
    {
        return $this->request('GET', '/v2/bot/richmenu/' . rawurlencode($richMenuId));
    }

    /**
     * Delete a rich menu.
     *
     * @param  string  $richMenuId  Rich menu ID
     * @return array<string, mixed>
     */
    public function deleteRichMenu(string $richMenuId): array
    {
        return $this->request('DELETE', '/v2/bot/richmenu/' . rawurlencode($richMenuId));
    }

    /**
     * Set default rich menu.
     *
     * @param  string  $richMenuId  Rich menu ID
     * @return array<string, mixed>
     */
    public function setDefaultRichMenu(string $richMenuId): array
    {
        return $this->request('POST', '/v2/bot/user/all/richmenu/' . rawurlencode($richMenuId));
    }

    /**
     * Get default rich menu ID.
     *
     * @return array<string, mixed>
     */
    public function getDefaultRichMenu(): array
    {
        return $this->request('GET', '/v2/bot/user/all/richmenu');
    }

    /**
     * Clear default rich menu.
     *
     * @return array<string, mixed>
     */
    public function clearDefaultRichMenu(): array
    {
        return $this->request('DELETE', '/v2/bot/user/all/richmenu');
    }

    /**
     * Link a rich menu to a user.
     *
     * @param  string  $userId  User ID
     * @param  string  $richMenuId  Rich menu ID
     * @return array<string, mixed>
     */
    public function linkRichMenuToUser(string $userId, string $richMenuId): array
    {
        return $this->request('POST', '/v2/bot/user/' . rawurlencode($userId) . '/richmenu/' . rawurlencode($richMenuId));
    }

    /**
     * Get rich menu ID linked to a user.
     *
     * @param  string  $userId  User ID
     * @return array<string, mixed>
     */
    public function getUserRichMenu(string $userId): array
    {
        return $this->request('GET', '/v2/bot/user/' . rawurlencode($userId) . '/richmenu');
    }

    /**
     * Unlink a rich menu from a user.
     *
     * @param  string  $userId  User ID
     * @return array<string, mixed>
     */
    public function unlinkRichMenuFromUser(string $userId): array
    {
        return $this->request('DELETE', '/v2/bot/user/' . rawurlencode($userId) . '/richmenu');
    }

    /**
     * Issue an account link token.
     *
     * @param  string  $userId  User ID
     * @return array<string, mixed>
     */
    public function issueLinkToken(string $userId): array
    {
        return $this->request('POST', '/v2/bot/user/' . rawurlencode($userId) . '/linkToken');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Request data or query parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['message' => trim($response->body())];
    }

    /**
     * Dispatch a raw LINE Messaging API request.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Request data or query parameters
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if ($this->accessToken === '') {
            throw new RuntimeException('LINE Messaging API access token is not configured.');
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
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("LINE API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to LINE API: {$e->getMessage()}");
        }
    }

    /**
     * Log and throw a normalized LINE API error.
     *
     * @throws RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("LINE API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new RuntimeException("LINE API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the access token may be invalid.");
        }

        $error = $response->json('message') ?? $body;

        Log::error("LINE API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("LINE API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
