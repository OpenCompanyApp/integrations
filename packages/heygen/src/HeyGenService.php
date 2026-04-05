<?php

namespace OpenCompany\Integrations\HeyGen;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HeyGen API service for interacting with the HeyGen v2 video generation platform.
 *
 * Handles authentication, request execution, and error handling for all HeyGen
 * endpoints including video generation, avatar management, voice listing, and
 * user information retrieval.
 */
class HeyGenService
{
    /**
     * Create a new HeyGen service instance.
     *
     * @param  string  $apiKey  HeyGen API key for Bearer token authentication.
     * @param  string  $baseUrl  Base URL for the HeyGen API (defaults to https://api.heygen.com/v2).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.heygen.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /**
     * Generate a new video using the HeyGen video generation API.
     *
     * Accepts a full request body as specified by the HeyGen API, including
     * avatar selection, voice configuration, script, and video settings.
     *
     * @param  array  $body  The video generation request payload.
     * @return array The API response containing the video ID and status.
     */
    public function createVideo(array $body): array
    {
        return $this->request('POST', '/video/generate', $body);
    }

    /**
     * Retrieve the status and details of a video by its ID.
     *
     * @param  string  $videoId  The unique identifier of the video.
     * @return array The video details including status, URL, and metadata.
     */
    public function getVideo(string $videoId): array
    {
        return $this->request('GET', '/video/' . urlencode($videoId));
    }

    /**
     * List videos with optional pagination.
     *
     * @param  int  $limit  Maximum number of videos to return per page.
     * @param  int|null  $offset  Offset for pagination (0-based).
     * @return array The paginated list of videos.
     */
    public function listVideos(int $limit = 10, ?int $offset = null): array
    {
        $params = ['limit' => $limit];
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/video/list', $params);
    }

    /**
     * List available avatars for video generation.
     *
     * @return array The list of available avatars with their details.
     */
    public function listAvatars(): array
    {
        return $this->request('GET', '/avatar/list');
    }

    /**
     * Retrieve details of a specific avatar by its ID.
     *
     * @param  string  $avatarId  The unique identifier of the avatar.
     * @return array The avatar details including preview images and configuration options.
     */
    public function getAvatar(string $avatarId): array
    {
        return $this->request('GET', '/avatar/' . urlencode($avatarId));
    }

    /**
     * List available voices for video generation.
     *
     * @return array The list of available voices with language and gender details.
     */
    public function listVoices(): array
    {
        return $this->request('GET', '/voice/list');
    }

    /**
     * Create a new avatar.
     *
     * @param  array  $body  The avatar creation request payload (e.g., training video URL, name).
     * @return array The created avatar details.
     */
    public function createAvatar(array $body): array
    {
        return $this->request('POST', '/avatar', $body);
    }

    /**
     * Retrieve the current authenticated user's account information.
     *
     * @return array The user profile including plan details, remaining credits, and usage.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user/info');
    }

    /**
     * Make an API request and return the parsed JSON response.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array  $data  Request payload or query parameters.
     * @return array The parsed JSON response body.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Execute a raw HTTP request to the HeyGen API.
     *
     * Handles Bearer token authentication, error detection, and logging.
     * Throws a RuntimeException on connection failures or API errors.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array  $data  Request payload or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('HeyGen API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("HeyGen API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("HeyGen API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("HeyGen API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("HeyGen API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("HeyGen API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to HeyGen API: {$e->getMessage()}");
        }
    }
}
