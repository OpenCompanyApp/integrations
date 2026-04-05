<?php

namespace OpenCompany\Integrations\Spotify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SpotifyService
{
    /**
     * Create a new SpotifyService instance.
     *
     * @param  string  $accessToken  OAuth access token for the Spotify Web API.
     * @param  string  $baseUrl  Base URL for the Spotify API (defaults to https://api.spotify.com/v1).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.spotify.com/v1',
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
     * Search for tracks, artists, albums, or playlists on Spotify.
     *
     * @param  string  $q  The search query string.
     * @param  string|array<string>  $type  One or more types to search: "track", "artist", "album", "playlist".
     * @param  int  $limit  Maximum number of results (default 20, max 50).
     * @param  int  $offset  The index of the first result to return (default 0).
     * @return array<string, mixed> The search results grouped by type.
     */
    public function search(string $q, string|array $type = 'track', int $limit = 20, int $offset = 0): array
    {
        $params = [
            'q' => $q,
            'type' => is_array($type) ? implode(',', $type) : $type,
            'limit' => $limit,
            'offset' => $offset,
        ];

        return $this->request('GET', '/search', $params);
    }

    /**
     * Get detailed information about a track.
     *
     * @param  string  $id  The Spotify track ID.
     * @return array<string, mixed> The track object.
     */
    public function getTrack(string $id): array
    {
        return $this->request('GET', '/tracks/' . urlencode($id));
    }

    /**
     * Get detailed information about an artist.
     *
     * @param  string  $id  The Spotify artist ID.
     * @return array<string, mixed> The artist object.
     */
    public function getArtist(string $id): array
    {
        return $this->request('GET', '/artists/' . urlencode($id));
    }

    /**
     * List the current user's playlists.
     *
     * @param  int  $limit  Maximum number of playlists to return (default 20, max 50).
     * @param  int  $offset  The index of the first playlist to return (default 0).
     * @return array<string, mixed> Paginated list of playlists.
     */
    public function listPlaylists(int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/me/playlists', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get detailed information about a playlist.
     *
     * @param  string  $id  The Spotify playlist ID.
     * @param  int  $limit  Maximum number of tracks to return (default 20, max 100).
     * @param  int  $offset  The index of the first track to return (default 0).
     * @return array<string, mixed> The playlist object with tracks.
     */
    public function getPlaylist(string $id, int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/playlists/' . urlencode($id), [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Create a new playlist for a user.
     *
     * @param  string  $userId  The Spotify user ID.
     * @param  string  $name  The name for the new playlist.
     * @param  string  $description  Optional description for the playlist.
     * @param  bool  $public  Whether the playlist should be public (default true).
     * @return array<string, mixed> The newly created playlist object.
     */
    public function createPlaylist(string $userId, string $name, string $description = '', bool $public = true): array
    {
        $body = [
            'name' => $name,
            'public' => $public,
        ];

        if ($description !== '') {
            $body['description'] = $description;
        }

        return $this->request('POST', '/users/' . urlencode($userId) . '/playlists', $body);
    }

    /**
     * List an artist's albums.
     *
     * @param  string  $id  The Spotify artist ID.
     * @param  string  $includeGroups  Album types to include: "album", "single", "appears_on", "compilation" (comma-separated).
     * @param  int  $limit  Maximum number of albums to return (default 20, max 50).
     * @param  int  $offset  The index of the first album to return (default 0).
     * @return array<string, mixed> Paginated list of albums.
     */
    public function listAlbums(string $id, string $includeGroups = 'album,single', int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/artists/' . urlencode($id) . '/albums', [
            'include_groups' => $includeGroups,
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed> The user profile object.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return array<string, mixed> Parsed JSON response body.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Spotify Web API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the access token is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Spotify access token is not configured.');
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
                $json = $response->json();
                $error = $json['error']['message'] ?? $response->body();

                Log::error("Spotify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Spotify API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Spotify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Spotify API: {$e->getMessage()}");
        }
    }
}
