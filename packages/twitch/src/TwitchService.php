<?php

namespace OpenCompany\Integrations\Twitch;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TwitchService
{
    public function __construct(
        private string $accessToken = '',
        private string $clientId = '',
        private string $baseUrl = 'https://api.twitch.tv/helix',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has the minimum required credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->clientId);
    }

    /**
     * Get a list of streams (live channels).
     *
     * @param  array<string, mixed>  $params  Query parameters (game_id, language, user_id, user_login, first, after, before).
     * @return array<string, mixed>
     */
    public function listStreams(array $params = []): array
    {
        return $this->request('GET', '/streams', $params);
    }

    /**
     * Get information about one or more Twitch users.
     *
     * @param  string|null  $id    User ID (optional).
     * @param  string|null  $login User login name (optional).
     * @return array<string, mixed>
     */
    public function getUser(?string $id = null, ?string $login = null): array
    {
        $params = [];
        if ($id !== null) {
            $params['id'] = $id;
        }
        if ($login !== null) {
            $params['login'] = $login;
        }

        return $this->request('GET', '/users', $params);
    }

    /**
     * Get information about one or more games.
     *
     * @param  string|null  $id   Game ID (optional).
     * @param  string|null  $name Game name (optional).
     * @return array<string, mixed>
     */
    public function listGames(?string $id = null, ?string $name = null): array
    {
        $params = [];
        if ($id !== null) {
            $params['id'] = $id;
        }
        if ($name !== null) {
            $params['name'] = $name;
        }

        return $this->request('GET', '/games', $params);
    }

    /**
     * Get information about a single game by ID.
     *
     * @param  string  $id  Game ID.
     * @return array<string, mixed>
     */
    public function getGame(string $id): array
    {
        return $this->request('GET', '/games', ['id' => $id]);
    }

    /**
     * Get a list of channels.
     *
     * @param  array<string, mixed>  $params  Query parameters (broadcaster_id, first, after).
     * @return array<string, mixed>
     */
    public function listChannels(array $params = []): array
    {
        return $this->request('GET', '/channels', $params);
    }

    /**
     * Get information about a specific channel by broadcaster ID.
     *
     * @param  string  $broadcasterId  The broadcaster's user ID.
     * @return array<string, mixed>
     */
    public function getChannel(string $broadcasterId): array
    {
        return $this->request('GET', '/channels', ['broadcaster_id' => $broadcasterId]);
    }

    /**
     * Search categories (games) by query string.
     *
     * @param  string  $query   Search query.
     * @param  int     $first   Number of results (max 100, default 20).
     * @param  string|null  $after  Cursor for pagination.
     * @return array<string, mixed>
     */
    public function searchCategories(string $query, int $first = 20, ?string $after = null): array
    {
        $params = [
            'query' => $query,
            'first' => $first,
        ];
        if ($after !== null) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/search/categories', $params);
    }

    /**
     * Get the authenticated user's information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users');
    }

    /**
     * Make an API request and return parsed JSON data.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE, PATCH).
     * @param  string  $path    API endpoint path (e.g. "/streams").
     * @param  array<string, mixed>  $params  Query or body parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        $response = $this->rawRequest($method, $path, $params);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Twitch Helix API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $params  Query or body parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $params = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken || !$this->clientId) {
            throw new \RuntimeException('Twitch access token and client ID are required.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Client-Id' => $this->clientId,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'PATCH' => $http->patch($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Twitch API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Twitch API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unreachable.");
                }

                $error = $response->json('message') ?? $body;
                Log::error("Twitch API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Twitch API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Twitch API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Twitch API: {$e->getMessage()}");
        }
    }
}
