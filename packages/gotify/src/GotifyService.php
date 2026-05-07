<?php

namespace OpenCompany\Integrations\Gotify;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Gotify REST API.
 *
 * Separates application-token message sending from client-token management calls.
 */
class GotifyService
{
    /**
     * @param  string  $appToken  Gotify application token used only for sending messages.
     * @param  string  $baseUrl  Base URL of the Gotify server.
     * @param  string  $clientToken  Gotify client token used for message, application, client, and user management.
     */
    public function __construct(
        private string $appToken = '',
        private string $baseUrl = 'https://gotify.example.com',
        private string $clientToken = '',
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
     * Check whether client-token management calls are configured.
     */
    public function isClientConfigured(): bool
    {
        return !empty($this->clientToken);
    }

    /**
     * Check whether the server URL can be reached for unauthenticated info calls.
     */
    public function hasServerUrl(): bool
    {
        return $this->baseUrl !== '';
    }

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    /**
     * List all messages visible to the configured client token.
     *
     * @param  int  $limit  Maximum number of messages to return (default 100, max 200).
     * @param  int|null  $since  Return messages with ID less than this value.
     * @return array<string, mixed>
     */
    public function listMessages(int $limit = 100, ?int $since = null): array
    {
        $params = ['limit' => $limit];
        if ($since !== null) {
            $params['since'] = $since;
        }

        return $this->request('GET', '/message', $params, tokenType: 'client');
    }

    /**
     * Create (send) a new message.
     *
     * @param  string  $title  Message title.
     * @param  string  $message  Message body (supports Markdown).
     * @param  int  $priority  Message priority (0–10, default 5).
     * @param  array<string, mixed>  $extras  Optional Gotify message extras.
     * @return array<string, mixed>
     */
    public function createMessage(string $title, string $message, int $priority = 5, array $extras = []): array
    {
        $payload = [
            'title' => $title,
            'message' => $message,
            'priority' => $priority,
        ];

        if ($extras !== []) {
            $payload['extras'] = $extras;
        }

        return $this->request('POST', '/message', $payload, tokenType: 'app');
    }

    /**
     * Delete a message by its ID.
     *
     * @param  int  $id  The message ID to delete.
     */
    public function deleteMessage(int $id): void
    {
        $this->request('DELETE', '/message/' . $id, tokenType: 'client');
    }

    /**
     * Delete all messages visible to the configured client token.
     */
    public function deleteMessages(): void
    {
        $this->request('DELETE', '/message', tokenType: 'client');
    }

    /**
     * List messages sent by a specific application.
     *
     * @param  int  $applicationId  Gotify application id.
     * @param  int  $limit  Maximum number of messages to return.
     * @param  int|null  $since  Return messages with ID less than this value.
     * @return array<string, mixed>
     */
    public function listApplicationMessages(int $applicationId, int $limit = 100, ?int $since = null): array
    {
        $params = ['limit' => $limit];

        if ($since !== null) {
            $params['since'] = $since;
        }

        return $this->request('GET', "/application/{$applicationId}/message", $params, tokenType: 'client');
    }

    /**
     * Delete all messages sent by a specific application.
     *
     * @param  int  $applicationId  Gotify application id.
     */
    public function deleteApplicationMessages(int $applicationId): void
    {
        $this->request('DELETE', "/application/{$applicationId}/message", tokenType: 'client');
    }

    /*
    |--------------------------------------------------------------------------
    | Applications
    |--------------------------------------------------------------------------
    */

    /**
     * List applications visible to the configured client token.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listApplications(): array
    {
        return $this->request('GET', '/application', tokenType: 'client');
    }

    /**
     * Create a Gotify application and return its generated application token.
     *
     * @param  array<string, mixed>  $data  Application fields (name, description).
     * @return array<string, mixed>
     */
    public function createApplication(array $data): array
    {
        return $this->request('POST', '/application', $data, tokenType: 'client');
    }

    /**
     * Update a Gotify application.
     *
     * @param  int  $id  Application id.
     * @param  array<string, mixed>  $data  Application fields (name, description).
     * @return array<string, mixed>
     */
    public function updateApplication(int $id, array $data): array
    {
        return $this->request('PUT', "/application/{$id}", $data, tokenType: 'client');
    }

    /**
     * Delete a Gotify application.
     *
     * Requires elevated authentication on Gotify servers.
     *
     * @param  int  $id  Application id.
     */
    public function deleteApplication(int $id): void
    {
        $this->request('DELETE', "/application/{$id}", tokenType: 'client');
    }

    /*
    |--------------------------------------------------------------------------
    | Clients
    |--------------------------------------------------------------------------
    */

    /**
     * List clients visible to the configured client token.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listClients(): array
    {
        return $this->request('GET', '/client', tokenType: 'client');
    }

    /**
     * Create a Gotify client and return its generated client token.
     *
     * @param  array<string, mixed>  $data  Client fields (name).
     * @return array<string, mixed>
     */
    public function createClient(array $data): array
    {
        return $this->request('POST', '/client', $data, tokenType: 'client');
    }

    /**
     * Update a Gotify client.
     *
     * @param  int  $id  Client id.
     * @param  array<string, mixed>  $data  Client fields (name).
     * @return array<string, mixed>
     */
    public function updateClient(int $id, array $data): array
    {
        return $this->request('PUT', "/client/{$id}", $data, tokenType: 'client');
    }

    /**
     * Delete a Gotify client.
     *
     * Requires elevated authentication on Gotify servers.
     *
     * @param  int  $id  Client id.
     */
    public function deleteClient(int $id): void
    {
        $this->request('DELETE', "/client/{$id}", tokenType: 'client');
    }

    /*
    |--------------------------------------------------------------------------
    | Info and users
    |--------------------------------------------------------------------------
    */

    /**
     * Get the health status of the Gotify server.
     *
     * @return array<string, mixed>
     */
    public function getHealth(): array
    {
        return $this->request('GET', '/health', tokenType: 'none');
    }

    /**
     * Get Gotify server version information.
     *
     * @return array<string, mixed>
     */
    public function getVersion(): array
    {
        return $this->request('GET', '/version', tokenType: 'none');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/current/user', tokenType: 'client');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE).
     * @param  string  $tokenType  Authentication mode: none, app, or client.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], string $tokenType = 'app'): array
    {
        $response = $this->rawRequest($method, $path, $data, $tokenType);

        if ($response->status() === 204 || $response->body() === '') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Gotify API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @param  string  $tokenType  Authentication mode: none, app, or client.
     * @return Response
     *
     * @throws RuntimeException When the required token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = [], string $tokenType = 'app'): Response
    {
        $token = match ($tokenType) {
            'app' => $this->appToken,
            'client' => $this->clientToken,
            'none' => null,
            default => throw new RuntimeException("Unsupported Gotify token type: {$tokenType}"),
        };

        if ($tokenType === 'app' && !$token) {
            throw new RuntimeException('Gotify app token is not configured.');
        }

        if ($tokenType === 'client' && !$token) {
            throw new RuntimeException('Gotify client token is not configured. This endpoint requires a client token, not an application token.');
        }

        $url = $this->baseUrl . $path;

        try {
            $headers = [
                'Content-Type' => 'application/json',
            ];

            if ($token !== null) {
                $headers['X-Gotify-Key'] = $token;
            }

            $http = Http::withHeaders($headers)->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful() && !($path === '/health' && $response->status() === 500)) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Gotify API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Gotify API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('errorDescription') ?? $body;
                Log::error("Gotify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Gotify API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Gotify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Gotify API: {$e->getMessage()}");
        }
    }
}
