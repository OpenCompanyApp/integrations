<?php

namespace OpenCompany\Integrations\Vimeo;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Vimeo REST API.
 *
 * Handles bearer authentication, video, album, folder, channel, comment,
 * text-track, picture, category, and generic endpoint requests.
 */
class VimeoService
{
    /**
     * @param  string  $accessToken  Vimeo OAuth access token or personal access token.
     * @param  string  $baseUrl  Vimeo API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.vimeo.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * List videos for the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listVideos(array $params = []): array
    {
        return $this->request('GET', '/me/videos', $params);
    }

    /**
     * Get a single video by ID.
     *
     * @return array<string, mixed>
     */
    public function getVideo(string $videoId): array
    {
        return $this->request('GET', '/videos/' . rawurlencode($videoId));
    }

    /**
     * Create a video upload resource.
     *
     * @param  array<string, mixed>  $data  Video creation payload.
     * @return array<string, mixed>
     */
    public function createVideo(array $data): array
    {
        return $this->request('POST', '/me/videos', $data);
    }

    /**
     * Backward-compatible upload-ticket alias.
     *
     * @param  array<string, mixed>  $data  Video upload payload.
     * @return array<string, mixed>
     */
    public function uploadVideo(array $data): array
    {
        $payload = $data;
        $payload['upload'] ??= ['approach' => 'post'];

        return $this->createVideo($payload);
    }

    /**
     * Update a video.
     *
     * @param  array<string, mixed>  $data  Video update payload.
     * @return array<string, mixed>
     */
    public function updateVideo(string $videoId, array $data): array
    {
        return $this->request('PATCH', '/videos/' . rawurlencode($videoId), $data);
    }

    /**
     * Delete a video.
     *
     * @return array<string, mixed>
     */
    public function deleteVideo(string $videoId): array
    {
        return $this->request('DELETE', '/videos/' . rawurlencode($videoId));
    }

    /**
     * List video comments.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listVideoComments(string $videoId, array $params = []): array
    {
        return $this->request('GET', '/videos/' . rawurlencode($videoId) . '/comments', $params);
    }

    /**
     * Create a video comment.
     *
     * @return array<string, mixed>
     */
    public function createVideoComment(string $videoId, string $text): array
    {
        return $this->request('POST', '/videos/' . rawurlencode($videoId) . '/comments', ['text' => $text]);
    }

    /**
     * List video text tracks.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listVideoTextTracks(string $videoId, array $params = []): array
    {
        return $this->request('GET', '/videos/' . rawurlencode($videoId) . '/texttracks', $params);
    }

    /**
     * Create a video text track.
     *
     * @param  array<string, mixed>  $data  Text track payload.
     * @return array<string, mixed>
     */
    public function createVideoTextTrack(string $videoId, array $data): array
    {
        return $this->request('POST', '/videos/' . rawurlencode($videoId) . '/texttracks', $data);
    }

    /**
     * List video pictures.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listVideoPictures(string $videoId, array $params = []): array
    {
        return $this->request('GET', '/videos/' . rawurlencode($videoId) . '/pictures', $params);
    }

    /**
     * Create a video picture resource.
     *
     * @param  array<string, mixed>  $data  Picture payload.
     * @return array<string, mixed>
     */
    public function createVideoPicture(string $videoId, array $data = []): array
    {
        return $this->request('POST', '/videos/' . rawurlencode($videoId) . '/pictures', $data);
    }

    /**
     * List albums for the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAlbums(array $params = []): array
    {
        return $this->request('GET', '/me/albums', $params);
    }

    /**
     * Get one album.
     *
     * @return array<string, mixed>
     */
    public function getAlbum(string $albumId): array
    {
        return $this->request('GET', '/me/albums/' . rawurlencode($albumId));
    }

    /**
     * Create an album/showcase.
     *
     * @param  array<string, mixed>  $data  Album creation payload.
     * @return array<string, mixed>
     */
    public function createAlbum(array $data): array
    {
        return $this->request('POST', '/me/albums', $data);
    }

    /**
     * Update an album/showcase.
     *
     * @param  array<string, mixed>  $data  Album update payload.
     * @return array<string, mixed>
     */
    public function updateAlbum(string $albumId, array $data): array
    {
        return $this->request('PATCH', '/me/albums/' . rawurlencode($albumId), $data);
    }

    /**
     * Delete an album/showcase.
     *
     * @return array<string, mixed>
     */
    public function deleteAlbum(string $albumId): array
    {
        return $this->request('DELETE', '/me/albums/' . rawurlencode($albumId));
    }

    /**
     * List videos in an album/showcase.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAlbumVideos(string $albumId, array $params = []): array
    {
        return $this->request('GET', '/me/albums/' . rawurlencode($albumId) . '/videos', $params);
    }

    /**
     * Add a video to an album/showcase.
     *
     * @return array<string, mixed>
     */
    public function addVideoToAlbum(string $albumId, string $videoId): array
    {
        return $this->request('PUT', '/me/albums/' . rawurlencode($albumId) . '/videos/' . rawurlencode($videoId));
    }

    /**
     * Remove a video from an album/showcase.
     *
     * @return array<string, mixed>
     */
    public function removeVideoFromAlbum(string $albumId, string $videoId): array
    {
        return $this->request('DELETE', '/me/albums/' . rawurlencode($albumId) . '/videos/' . rawurlencode($videoId));
    }

    /**
     * List folders/projects for the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listFolders(array $params = []): array
    {
        return $this->request('GET', '/me/folders', $params);
    }

    /**
     * Create a folder/project.
     *
     * @param  array<string, mixed>  $data  Folder creation payload.
     * @return array<string, mixed>
     */
    public function createFolder(array $data): array
    {
        return $this->request('POST', '/me/folders', $data);
    }

    /**
     * Update a folder/project.
     *
     * @param  array<string, mixed>  $data  Folder update payload.
     * @return array<string, mixed>
     */
    public function updateFolder(string $folderId, array $data): array
    {
        return $this->request('PATCH', '/me/folders/' . rawurlencode($folderId), $data);
    }

    /**
     * Delete a folder/project.
     *
     * @return array<string, mixed>
     */
    public function deleteFolder(string $folderId): array
    {
        return $this->request('DELETE', '/me/folders/' . rawurlencode($folderId));
    }

    /**
     * List public channels.
     *
     * @return array<string, mixed>
     */
    public function listChannels(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/channels', ['page' => $page, 'per_page' => $perPage]);
    }

    /**
     * List categories.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCategories(array $params = []): array
    {
        return $this->request('GET', '/categories', $params);
    }

    /**
     * Get the authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Call a documented Vimeo GET endpoint.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * Call a documented Vimeo POST endpoint.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $path, $body);
    }

    /**
     * Call a documented Vimeo PATCH endpoint.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $body = []): array
    {
        return $this->request('PATCH', $path, $body);
    }

    /**
     * Call a documented Vimeo DELETE endpoint.
     *
     * @param  array<string, mixed>  $body  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $path, $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params or body data.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Vimeo API.
     *
     * @param  array<string, mixed>  $data  Query params or body data.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if ($this->accessToken === '') {
            throw new \RuntimeException('Vimeo access token is not configured.');
        }

        $url = $this->url($path);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/vnd.vimeo.*+json;version=3.4',
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
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Vimeo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Vimeo API: {$e->getMessage()}");
        }
    }

    /**
     * Build a full API URL from a relative path.
     */
    private function url(string $path): string
    {
        $path = ltrim(trim($path), '/');

        if ($path === '') {
            throw new \InvalidArgumentException('Vimeo API path is required.');
        }

        if (preg_match('#^https?://#i', $path) === 1) {
            throw new \InvalidArgumentException('Use a Vimeo API path relative to the configured base URL.');
        }

        return $this->baseUrl . '/' . $path;
    }

    /**
     * Throw a normalized API exception.
     *
     * @throws \RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = (string) $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Vimeo API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);
            throw new \RuntimeException("Vimeo API returned an unexpected response (HTTP {$response->status()}). Check the base URL and access token.");
        }

        $error = $response->json('error') ?? $response->json('message') ?? $body;
        Log::error("Vimeo API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);
        throw new \RuntimeException("Vimeo API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
