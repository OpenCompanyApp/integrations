<?php

namespace OpenCompany\Integrations\Telegram;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.telegram.org',
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
     * Get the base API URL with bot token embedded.
     */
    private function apiUrl(string $method): string
    {
        return $this->baseUrl . '/bot' . $this->accessToken . '/' . $method;
    }

    /**
     * Send a text message to a chat.
     *
     * @param  int|string  $chatId   Unique identifier or @username for the target chat.
     * @param  string      $text     Text of the message to send.
     * @param  array       $options  Optional parameters (parse_mode, reply_to_message_id, etc.).
     * @return array<string, mixed>
     */
    public function sendMessage(int|string $chatId, string $text, array $options = []): array
    {
        return $this->request('POST', 'sendMessage', array_merge([
            'chat_id' => $chatId,
            'text' => $text,
        ], $options));
    }

    /**
     * Send a photo to a chat.
     *
     * @param  int|string  $chatId  Unique identifier or @username for the target chat.
     * @param  string      $photo   URL of the photo or file_id of an existing photo.
     * @param  array       $options Optional parameters (caption, parse_mode, etc.).
     * @return array<string, mixed>
     */
    public function sendPhoto(int|string $chatId, string $photo, array $options = []): array
    {
        return $this->request('POST', 'sendPhoto', array_merge([
            'chat_id' => $chatId,
            'photo' => $photo,
        ], $options));
    }

    /**
     * Get incoming updates (messages, callbacks, etc.).
     *
     * @param  int|null  $offset    Identifier of the first update to return.
     * @param  int       $limit     Number of updates to fetch (1–100).
     * @param  int       $timeout   Long polling timeout in seconds.
     * @return array<string, mixed>
     */
    public function listUpdates(?int $offset = null, int $limit = 100, int $timeout = 0): array
    {
        $params = [
            'limit' => $limit,
            'timeout' => $timeout,
        ];

        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', 'getUpdates', $params);
    }

    /**
     * Get bot information.
     *
     * @return array<string, mixed>
     */
    public function getMe(): array
    {
        return $this->request('GET', 'getMe');
    }

    /**
     * Get information about a chat.
     *
     * @param  int|string  $chatId  Unique identifier or @username of the target chat.
     * @return array<string, mixed>
     */
    public function getChat(int|string $chatId): array
    {
        return $this->request('GET', 'getChat', [
            'chat_id' => $chatId,
        ]);
    }

    /**
     * Get the currently authenticated bot user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->getMe();
    }

    /**
     * Make an API request and return parsed JSON result.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $api     Telegram Bot API method name.
     * @param  array   $data    Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $api, array $data = []): array
    {
        $response = $this->rawRequest($method, $api, $data);

        if ($response->status() === 204) {
            return [];
        }

        $json = $response->json();

        // Telegram wraps responses in {ok: true, result: ...}
        if (is_array($json) && isset($json['ok']) && $json['ok'] === true) {
            return $json['result'] ?? [];
        }

        return $json ?? [];
    }

    /**
     * Make a raw HTTP request to the Telegram Bot API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $api     Telegram Bot API method name.
     * @param  array   $data    Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $api, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Telegram bot token is not configured.');
        }

        $url = $this->apiUrl($api);

        try {
            $http = Http::withHeaders([
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Telegram API returned HTML for {$method} {$api}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Telegram API endpoint not available (HTTP {$response->status()}). The token may be incorrect.");
                }

                $json = $response->json();
                $error = $json['description'] ?? $json['error'] ?? $body;
                Log::error("Telegram API error: {$method} {$api}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Telegram API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            // Check Telegram's own ok field
            $json = $response->json();
            if (is_array($json) && isset($json['ok']) && $json['ok'] === false) {
                $error = $json['description'] ?? 'Unknown Telegram API error';
                $errorCode = $json['error_code'] ?? $response->status();
                Log::error("Telegram API error: {$method} {$api}", [
                    'error_code' => $errorCode,
                    'description' => $error,
                ]);
                throw new \RuntimeException("Telegram API error ({$errorCode}): {$error}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Telegram API connection error: {$method} {$api}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Telegram API: {$e->getMessage()}");
        }
    }
}
