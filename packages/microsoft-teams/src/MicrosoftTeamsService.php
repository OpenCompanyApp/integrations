<?php

namespace OpenCompany\Integrations\MicrosoftTeams;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for Microsoft Teams operations through Microsoft Graph.
 *
 * Handles bearer-token authentication, request dispatch, error normalization,
 * and response parsing for team, channel, message, chat, and user endpoints.
 */
class MicrosoftTeamsService
{
    /**
     * Create a new MicrosoftTeamsService instance.
     *
     * @param  string  $accessToken  The OAuth2 access token for the Microsoft Graph API.
     * @param  string  $baseUrl  The base URL for the Microsoft Graph API.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://graph.microsoft.com/v1.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the teams that the authenticated user has joined.
     *
     * @return array<string, mixed>
     */
    public function listTeams(): array
    {
        return $this->request('GET', '/me/joinedTeams');
    }

    /**
     * Get the properties of a specific team.
     *
     * @param  string  $teamId  The unique identifier of the team.
     * @return array<string, mixed>
     */
    public function getTeam(string $teamId): array
    {
        return $this->request('GET', '/teams/' . rawurlencode($teamId));
    }

    /**
     * List all channels in a team.
     *
     * @param  string  $teamId  The unique identifier of the team.
     * @return array<string, mixed>
     */
    public function listChannels(string $teamId): array
    {
        return $this->request('GET', '/teams/' . rawurlencode($teamId) . '/channels');
    }

    /**
     * Get the properties of a specific channel.
     *
     * @param  string  $teamId     The unique identifier of the team.
     * @param  string  $channelId  The unique identifier of the channel.
     * @return array<string, mixed>
     */
    public function getChannel(string $teamId, string $channelId): array
    {
        return $this->request('GET', '/teams/' . rawurlencode($teamId) . '/channels/' . rawurlencode($channelId));
    }

    /**
     * List messages in a channel.
     *
     * @param  string  $teamId     The unique identifier of the team.
     * @param  string  $channelId  The unique identifier of the channel.
     * @param  int     $limit      Maximum number of messages to return (default: 50).
     * @return array<string, mixed>
     */
    public function listMessages(string $teamId, string $channelId, int $limit = 50): array
    {
        return $this->request('GET', '/teams/' . rawurlencode($teamId) . '/channels/' . rawurlencode($channelId) . '/messages', [
            '$top' => $limit,
        ]);
    }

    /**
     * Send a message to a channel.
     *
     * @param  string  $teamId     The unique identifier of the team.
     * @param  string  $channelId  The unique identifier of the channel.
     * @param  string  $content    The message body content.
     * @param  string  $contentType  The content type — "text" or "html" (default: "text").
     * @return array<string, mixed>
     */
    public function sendMessage(string $teamId, string $channelId, string $content, string $contentType = 'text'): array
    {
        return $this->request('POST', '/teams/' . rawurlencode($teamId) . '/channels/' . rawurlencode($channelId) . '/messages', [
            'body' => [
                'content' => $content,
                'contentType' => $contentType,
            ],
        ]);
    }

    /**
     * List chats for the authenticated user.
     *
     * @param  int  $limit  Maximum number of chats to return (default: 50).
     * @return array<string, mixed>
     */
    public function listChats(int $limit = 50): array
    {
        return $this->request('GET', '/me/chats', [
            '$top' => $limit,
        ]);
    }

    /**
     * Get the profile of the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string  $path    API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Microsoft Graph API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string  $path    API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Microsoft Teams access token is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $errorBody = $response->json();
                $errorMessage = $errorBody['error']['message'] ?? $response->body();

                Log::error("Microsoft Graph API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $errorMessage,
                ]);

                throw new \RuntimeException("Microsoft Graph API error ({$response->status()}): " . (is_string($errorMessage) ? $errorMessage : json_encode($errorMessage)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Microsoft Graph API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Microsoft Graph API: {$e->getMessage()}");
        }
    }
}
