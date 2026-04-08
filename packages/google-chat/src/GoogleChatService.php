<?php

namespace OpenCompany\Integrations\GoogleChat;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleChatService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://chat.googleapis.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List spaces the authenticated user belongs to.
     *
     * @param  int  $pageSize  Maximum number of spaces to return (1–1000, default 100).
     * @param  string|null  $pageToken  Page token from a previous response for pagination.
     * @return array{spaces: array, nextPageToken?: string}
     */
    public function listSpaces(int $pageSize = 100, ?string $pageToken = null): array
    {
        $params = ['pageSize' => $pageSize];
        if ($pageToken) {
            $params['pageToken'] = $pageToken;
        }

        return $this->request('GET', '/v1/spaces', $params);
    }

    /**
     * Get details for a specific space.
     *
     * @param  string  $name  Resource name of the space (e.g., "spaces/AAAAAAAAAAA").
     * @return array
     */
    public function getSpace(string $name): array
    {
        return $this->request('GET', '/v1/' . $name);
    }

    /**
     * List messages in a space.
     *
     * @param  string  $parent  Resource name of the space (e.g., "spaces/AAAAAAAAAAA").
     * @param  int  $pageSize  Maximum number of messages to return (1–1000, default 1000).
     * @param  string|null  $pageToken  Page token from a previous response for pagination.
     * @return array
     */
    public function listMessages(string $parent, int $pageSize = 1000, ?string $pageToken = null): array
    {
        $params = ['pageSize' => $pageSize];
        if ($pageToken) {
            $params['pageToken'] = $pageToken;
        }

        return $this->request('GET', '/v1/' . $parent . '/messages', $params);
    }

    /**
     * Get a specific message.
     *
     * @param  string  $parent  Resource name of the space (e.g., "spaces/AAAAAAAAAAA").
     * @param  string  $name  Resource name of the message (e.g., "spaces/AAAAAAAAAAA/messages/BBBBBBBBBBB").
     * @return array
     */
    public function getMessage(string $parent, string $name): array
    {
        return $this->request('GET', '/v1/' . $parent . '/messages/' . $name);
    }

    /**
     * Create (send) a message in a space.
     *
     * @param  string  $parent  Resource name of the space (e.g., "spaces/AAAAAAAAAAA").
     * @param  string|null  $text  Plain-text body of the message.
     * @param  array|null  $cardsV2  Array of card widgets (Google Chat card v2 format).
     * @return array
     */
    public function createMessage(string $parent, ?string $text = null, ?array $cardsV2 = null): array
    {
        $body = [];
        if ($text !== null) {
            $body['text'] = $text;
        }
        if ($cardsV2 !== null) {
            $body['cardsV2'] = $cardsV2;
        }

        return $this->request('POST', '/v1/' . $parent . '/messages', $body);
    }

    /**
     * List memberships in a space.
     *
     * @param  string  $parent  Resource name of the space (e.g., "spaces/AAAAAAAAAAA").
     * @param  int  $pageSize  Maximum number of memberships to return (1–1000, default 1000).
     * @param  string|null  $pageToken  Page token from a previous response for pagination.
     * @return array
     */
    public function listMemberships(string $parent, int $pageSize = 1000, ?string $pageToken = null): array
    {
        $params = ['pageSize' => $pageSize];
        if ($pageToken) {
            $params['pageToken'] = $pageToken;
        }

        return $this->request('GET', '/v1/' . $parent . '/memberships', $params);
    }

    /**
     * Get the current user's membership in a space.
     *
     * @param  string  $parent  Resource name of the space (e.g., "spaces/AAAAAAAAAAA").
     * @return array
     */
    public function getCurrentUser(string $parent): array
    {
        return $this->request('GET', '/v1/' . $parent . '/memberships/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/v1/spaces").
     * @param  array  $data  Query parameters (GET) or JSON body (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Google Chat API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array  $data  Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Google Chat access token is not configured.');
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
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->body();
                Log::error("Google Chat API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Google Chat API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Chat API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Google Chat API: {$e->getMessage()}");
        }
    }
}
