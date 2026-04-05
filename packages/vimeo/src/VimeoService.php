<?php

namespace OpenCompany\Integrations\Vimeo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Vimeo API service — encapsulates all HTTP communication with the Vimeo REST API.
 *
 * Tools call service methods; they never make HTTP requests directly.
 * Supports configurable base URL (default: https://api.vimeo.com) and
 * Bearer token authentication via the access_token config field.
 */
class VimeoService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.vimeo.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Videos ────────────────────────────────────────────

    /**
     * List videos for the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, page, query, filter, etc.)
     * @return array<string, mixed>
     */
    public function listVideos(array $params = []): array
    {
        return $this->request('GET', '/me/videos', $params);
    }

    /**
     * Get a single video by its ID.
     *
     * @param  string  $videoId  The video URI path segment (e.g. "123456789")
     * @return array<string, mixed>
     */
    public function getVideo(string $videoId): array
    {
        return $this->request('GET', '/videos/' . urlencode($videoId));
    }

    /**
     * Create a new video upload slot.
     *
     * Initiates an upload via the approach specified (pull, post, or streaming).
     *
     * @param  array<string, mixed>  $data  Upload parameters (upload.approach, name, description, etc.)
     * @return array<string, mixed>
     */
    public function createVideo(array $data): array
    {
        return $this->request('POST', '/me/videos', $data);
    }

    // ── Albums ────────────────────────────────────────────

    /**
     * List albums for the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, page, query, etc.)
     * @return array<string, mixed>
     */
    public function listAlbums(array $params = []): array
    {
        return $this->request('GET', '/me/albums', $params);
    }

    // ── Folders ───────────────────────────────────────────

    /**
     * List folders (projects) for the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, page, query, etc.)
     * @return array<string, mixed>
     */
    public function listFolders(array $params = []): array
    {
        return $this->request('GET', '/me/folders', $params);
    }

    // ── User ──────────────────────────────────────────────

    /**
     * Get the authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    // ── HTTP ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, PATCH, DELETE)
     * @param  string  $path    API path (e.g. "/me/videos")
     * @param  array<string, mixed>  $data  Query params (GET) or body data (POST/PUT/PATCH)
     * @return array<string, mixed>
     *
     * @throws \RuntimeException on connection or API errors
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
     * @param  string  $method  HTTP method
     * @param  string  $path    API path
     * @param  array<string, mixed>  $data  Query params or body data
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException on missing credentials, connection errors, or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->accessToken) {
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
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

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Vimeo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Vimeo API: {$e->getMessage()}");
        }
    }
}
