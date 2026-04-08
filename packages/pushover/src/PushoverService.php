<?php

namespace OpenCompany\Integrations\Pushover;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PushoverService
{
    public function __construct(
        private string $apiKey = '',
        private string $userKey = '',
        private string $baseUrl = 'https://api.pushover.net/1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with the required credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->userKey);
    }

    /**
     * Get the configured user key.
     */
    public function getUserKey(): string
    {
        return $this->userKey;
    }

    /**
     * Send a push notification message.
     *
     * @param  string  $message  The notification message body.
     * @param  string|null  $title  Optional title for the notification.
     * @param  int|null  $priority  Message priority (-2 to 2). 0 = normal, 1 = high, 2 = emergency.
     * @param  array  $extra  Additional parameters (url, url_title, sound, device, timestamp, expire, retry, callback).
     * @return array The API response data.
     */
    public function sendMessage(string $message, ?string $title = null, ?int $priority = null, array $extra = []): array
    {
        $data = array_merge($extra, [
            'message' => $message,
        ]);

        if ($title !== null) {
            $data['title'] = $title;
        }

        if ($priority !== null) {
            $data['priority'] = $priority;
        }

        return $this->request('POST', '/messages.json', $data);
    }

    /**
     * List available notification sounds.
     *
     * @return array The API response containing available sounds.
     */
    public function listSounds(): array
    {
        return $this->request('GET', '/sounds.json');
    }

    /**
     * Validate the current user/device credentials.
     *
     * @return array The API response indicating whether the user is valid.
     */
    public function validateUser(): array
    {
        return $this->request('POST', '/users/validate.json');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API endpoint path.
     * @param  array  $data  Additional form parameters.
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Pushover API.
     *
     * Pushover authenticates via form parameters (user_key and token/app_key)
     * rather than HTTP headers, so credentials are sent in every request body.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API endpoint path.
     * @param  array  $data  Form parameters for the request.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If credentials are missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->userKey) {
            throw new \RuntimeException('Pushover API key and user key are not configured.');
        }

        $url = $this->baseUrl . $path;

        // Pushover uses form params for authentication
        $data['user'] = $this->userKey;
        $data['token'] = $this->apiKey;

        try {
            $http = Http::asForm()->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $body = $response->body();
                $json = $response->json();
                $errors = $json['errors'] ?? [];

                Log::error("Pushover API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'errors' => $errors,
                ]);

                $errorMessage = !empty($errors)
                    ? implode('; ', $errors)
                    : "HTTP {$response->status()}: {$body}";

                throw new \RuntimeException("Pushover API error: {$errorMessage}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Pushover API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Pushover API: {$e->getMessage()}");
        }
    }
}
