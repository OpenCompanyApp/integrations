<?php

namespace OpenCompany\Integrations\Vimeo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VimeoService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.vimeo.com',
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
     * List videos for the authenticated user.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Number of videos per page (max 100).
     * @return array<string, mixed>
     */
    public function listVideos(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/me/videos', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a single video by its ID.
     *
     * @param  int|string  $videoId  The video ID.
     * @return array<string, mixed>
     */
    public function getVideo(int|string $videoId): array
    {
        return $this->request('GET', '/videos/' . urlencode((string) $videoId));
    }

    /**
     * Create an upload ticket for a new video.
     *
     * Initializes a video upload via the POST approach and returns
     * the upload URL and newly created video object.
     *
     * @param  array<string, mixed> $params  Upload parameters (name, description, etc.).
     * @return array<string, mixed>
     */
    public function uploadVideo(array $params): array
    {
        $body = [
            'upload' => [
                'approach' => 'post',
            ],
        ];

        if (isset($params['name'])) {
            $body['name'] = $params['name'];
        }
        if (isset($params['description'])) {
            $body['description'] = $params['description'];
        }
        if (isset($params['privacy'])) {
            $body['privacy'] = $params['privacy'];
        }

        return $this->request('POST', '/me/videos', $body);
    }

    /**
     * Delete a video by its ID.
     *
     * @param  int|string  $videoId  The video ID.
     */
    public function deleteVideo(int|string $videoId): void
    {
        $this->request('DELETE', '/videos/' . urlencode((string) $videoId));
    }

    /**
     * List albums for the authenticated user.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Number of albums per page.
     * @return array<string, mixed>
     */
    public function listAlbums(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/me/albums', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a single album by its ID.
     *
     * @param  int|string  $albumId  The album ID.
     * @return array<string, mixed>
     */
    public function getAlbum(int|string $albumId): array
    {
        return $this->request('GET', '/me/albums/' . urlencode((string) $albumId));
    }

    /**
     * List public channels.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Number of channels per page.
     * @return array<string, mixed>
     */
    public function listChannels(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/channels', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
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
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Vimeo API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Vimeo access token is not configured.');
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Vimeo API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Vimeo API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Vimeo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Vimeo API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Vimeo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Vimeo API: {$e->getMessage()}");
        }
    }
}
