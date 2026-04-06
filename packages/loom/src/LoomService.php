<?php

namespace OpenCompany\Integrations\Loom;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Loom API service for managing videos, workspaces, and user information.
 *
 * Handles authentication and HTTP communication with the Loom REST API.
 * Supports configurable base URL for potential self-hosted or proxy setups.
 *
 * @see https://developer.loom.com/docs/api-reference
 */
class LoomService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.loom.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check if the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List videos with pagination support.
     *
     * @param  int  $limit  Maximum number of videos to return (default: 20, max: 50).
     * @param  int  $page  Page number for pagination (default: 1).
     * @return array<string, mixed> List of videos and pagination metadata.
     */
    public function listVideos(int $limit = 20, int $page = 1): array
    {
        return $this->request('GET', '/v1/videos', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single video by its ID.
     *
     * @param  string  $videoId  The unique identifier of the video.
     * @return array<string, mixed> Video details including playback URL, metadata, and status.
     */
    public function getVideo(string $videoId): array
    {
        return $this->request('GET', '/v1/videos/' . urlencode($videoId));
    }

    /**
     * Create a new video placeholder.
     *
     * @param  string  $title  The title of the video.
     * @param  string  $description  Optional description for the video.
     * @return array<string, mixed> Created video details including upload URLs.
     */
    public function createVideo(string $title, string $description = ''): array
    {
        $data = ['title' => $title];
        if ($description !== '') {
            $data['description'] = $description;
        }

        return $this->request('POST', '/v1/videos', $data);
    }

    /**
     * List folders with pagination support.
     *
     * @param  int  $limit  Maximum number of folders to return (default: 20).
     * @param  int  $page  Page number for pagination (default: 1).
     * @return array<string, mixed> List of folders and pagination metadata.
     */
    public function listFolders(int $limit = 20, int $page = 1): array
    {
        return $this->request('GET', '/v1/folders', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single folder by its ID.
     *
     * @param  string  $folderId  The unique identifier of the folder.
     * @return array<string, mixed> Folder details including name, video count, and hierarchy.
     */
    public function getFolder(string $folderId): array
    {
        return $this->request('GET', '/v1/folders/' . urlencode($folderId));
    }

    /**
     * Delete a video by its ID.
     *
     * @param  string  $videoId  The unique identifier of the video to delete.
     */
    public function deleteVideo(string $videoId): void
    {
        $this->request('DELETE', '/v1/videos/' . urlencode($videoId));
    }

    /**
     * List all workspaces accessible to the authenticated user.
     *
     * @return array<string, mixed> List of workspaces with names, IDs, and member counts.
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/v1/workspaces');
    }

    /**
     * Get the currently authenticated user's profile information.
     *
     * @return array<string, mixed> User profile including name, email, and account details.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., /v1/videos).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Loom API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing, the request fails, or the connection cannot be established.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Loom access token is not configured.');
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
                    Log::warning("Loom API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Loom API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Loom API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Loom API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Loom API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Loom API: {$e->getMessage()}");
        }
    }
}
