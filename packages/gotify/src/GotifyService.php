<?php

namespace OpenCompany\Integrations\Gotify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GotifyService
{
    public function __construct(
        private string $appToken = '',
        private string $baseUrl = 'https://gotify.example.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Gotify service is configured with an app token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->appToken);
    }

    /**
     * List messages for the application.
     *
     * @param  int  $limit  Maximum number of messages to return (default 100, max 200).
     * @param  int|null  $since  Return messages with ID greater than this value (for polling).
     * @return array<string, mixed>
     */
    public function listMessages(int $limit = 100, ?int $since = null): array
    {
        $params = ['limit' => $limit];
        if ($since !== null) {
            $params['since'] = $since;
        }

        return $this->request('GET', '/message', $params);
    }

    /**
     * Create (send) a new message.
     *
     * @param  string  $title  Message title.
     * @param  string  $message  Message body (supports Markdown).
     * @param  int  $priority  Message priority (0–10, default 5).
     * @return array<string, mixed>
     */
    public function createMessage(string $title, string $message, int $priority = 5): array
    {
        return $this->request('POST', '/message', [
            'title' => $title,
            'message' => $message,
            'priority' => $priority,
        ]);
    }

    /**
     * Delete a message by its ID.
     *
     * @param  int  $id  The message ID to delete.
     */
    public function deleteMessage(int $id): void
    {
        $this->request('DELETE', '/message/' . $id);
    }

    /**
     * Get the health status of the Gotify server.
     *
     * @return array<string, mixed>
     */
    public function getHealth(): array
    {
        return $this->request('GET', '/health');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/current/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Gotify API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->appToken) {
            throw new \RuntimeException('Gotify app token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Gotify-Key' => $this->appToken,
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
                    Log::warning("Gotify API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Gotify API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('errorDescription') ?? $body;
                Log::error("Gotify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Gotify API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Gotify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Gotify API: {$e->getMessage()}");
        }
    }
}
