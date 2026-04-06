<?php

namespace OpenCompany\Integrations\Telegram;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Telegram Bot API service for making authenticated requests to the Telegram Bot API.
 *
 * Handles all HTTP communication including message sending, photo uploads,
 * chat management, and bot information retrieval.
 */
class TelegramService
{
    public function __construct(
        private string $botToken = '',
        private string $baseUrl = 'https://api.telegram.org',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the bot token has been configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->botToken);
    }

    /**
     * Get information about the bot (authenticated user).
     *
     * @return array<string, mixed> Bot user object from the Telegram API
     */
    public function getMe(): array
    {
        return $this->request('GET', '/bot{token}/getMe');
    }

    /**
     * Send a text message to a chat.
     *
     * @param  string|int  $chatId  Unique identifier or username of the target chat
     * @param  string  $text  Message text (supports Markdown/HTML via parse_mode)
     * @param  array<string, mixed>  $options  Additional parameters (parse_mode, reply_markup, etc.)
     * @return array<string, mixed> Message object from the Telegram API
     */
    public function sendMessage(string|int $chatId, string $text, array $options = []): array
    {
        $data = array_merge([
            'chat_id' => $chatId,
            'text' => $text,
        ], $options);

        return $this->request('POST', '/bot{token}/sendMessage', $data);
    }

    /**
     * Send a photo to a chat.
     *
     * @param  string|int  $chatId  Unique identifier or username of the target chat
     * @param  string  $photo  URL of the photo or file_id of a previously uploaded photo
     * @param  array<string, mixed>  $options  Additional parameters (caption, parse_mode, reply_markup, etc.)
     * @return array<string, mixed> Message object from the Telegram API
     */
    public function sendPhoto(string|int $chatId, string $photo, array $options = []): array
    {
        $data = array_merge([
            'chat_id' => $chatId,
            'photo' => $photo,
        ], $options);

        return $this->request('POST', '/bot{token}/sendPhoto', $data);
    }

    /**
     * Get incoming updates (messages, callbacks, etc.) for the bot.
     *
     * @param  array<string, mixed>  $params  Optional parameters (offset, limit, timeout, allowed_updates)
     * @return array<int, array<string, mixed>> Array of Update objects
     */
    public function getUpdates(array $params = []): array
    {
        $result = $this->request('GET', '/bot{token}/getUpdates', $params);

        return $result;
    }

    /**
     * Get information about a chat.
     *
     * @param  string|int  $chatId  Unique identifier or username of the target chat
     * @return array<string, mixed> Chat object from the Telegram API
     */
    public function getChat(string|int $chatId): array
    {
        return $this->request('GET', '/bot{token}/getChat', [
            'chat_id' => $chatId,
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST)
     * @param  string  $path  API endpoint path (use {token} placeholder for bot token)
     * @param  array<string, mixed>  $data  Request parameters
     * @return array<string, mixed> Parsed JSON response
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Telegram Bot API.
     *
     * @param  string  $method  HTTP method (GET, POST)
     * @param  string  $path  API endpoint path (use {token} placeholder for bot token)
     * @param  array<string, mixed>  $data  Request parameters
     * @return \Illuminate\Http\Client\Response Raw HTTP response
     *
     * @throws \RuntimeException When the request fails or the service is not configured
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->botToken) {
            throw new \RuntimeException('Telegram Bot token is not configured.');
        }

        $url = $this->baseUrl . str_replace('{token}', $this->botToken, $path);

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $body = $response->body();
                $json = $response->json();

                $error = $json['description'] ?? $body;

                Log::error("Telegram API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Telegram API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            $jsonBody = $response->json();

            // Telegram API returns {"ok": true/false, "result": ...}
            if (isset($jsonBody['ok']) && $jsonBody['ok'] === false) {
                $error = $jsonBody['description'] ?? 'Unknown error';
                Log::error("Telegram API returned ok=false: {$method} {$path}", [
                    'error' => $error,
                ]);
                throw new \RuntimeException("Telegram API error: {$error}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Telegram API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Telegram API: {$e->getMessage()}");
        }
    }
}
