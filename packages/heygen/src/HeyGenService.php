<?php

namespace OpenCompany\Integrations\HeyGen;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HeyGenService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.heygen.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List videos with pagination.
     *
     * @param  int  $limit   Maximum number of videos to return (default 10, max 100).
     * @param  int  $offset  Number of videos to skip for pagination.
     * @return array<string, mixed>
     */
    public function listVideos(int $limit = 10, int $offset = 0): array
    {
        return $this->request('GET', '/v2/video.list', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get the status and details of a specific video.
     *
     * @param  string  $videoId  The unique identifier of the video.
     * @return array<string, mixed>
     */
    public function getVideo(string $videoId): array
    {
        return $this->request('GET', '/v2/video.status', [
            'video_id' => $videoId,
        ]);
    }

    /**
     * Create (generate) a new video.
     *
     * @param  array<int, mixed>  $videoInputs  Array of video input definitions (scenes, avatar, voice, etc.).
     * @param  array<string, int>|null  $dimension  Video dimensions, e.g. ["width" => 1920, "height" => 1080].
     * @param  bool  $test  Whether to generate a test (preview) video.
     * @return array<string, mixed>
     */
    public function createVideo(array $videoInputs, ?array $dimension = null, bool $test = false): array
    {
        $body = [
            'video_inputs' => $videoInputs,
            'test' => $test,
        ];

        if ($dimension !== null) {
            $body['dimension'] = $dimension;
        }

        return $this->request('POST', '/v2/video/generate', $body);
    }

    /**
     * List all available avatars.
     *
     * @return array<string, mixed>
     */
    public function listAvatars(): array
    {
        return $this->request('GET', '/v2/avatar.list');
    }

    /**
     * List all available voices.
     *
     * @return array<string, mixed>
     */
    public function listVoices(): array
    {
        return $this->request('GET', '/v2/voice.list');
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/user.info');
    }

    /**
     * List templates with pagination.
     *
     * @param  int  $limit   Maximum number of templates to return (default 10, max 100).
     * @param  int  $offset  Number of templates to skip for pagination.
     * @return array<string, mixed>
     */
    public function listTemplates(int $limit = 10, int $offset = 0): array
    {
        return $this->request('GET', '/v2/templates', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the HeyGen API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('HeyGen access token is not configured.');
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
                    Log::warning("HeyGen API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("HeyGen API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
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
