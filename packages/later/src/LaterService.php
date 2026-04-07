<?php

namespace OpenCompany\Integrations\Later;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LaterService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.later.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all social media profiles connected to the Later account.
     *
     * @param  int|null  $limit   Number of profiles to return per page.
     * @param  int|null  $page    Page number for pagination.
     * @return array<string, mixed>
     */
    public function listProfiles(?int $limit = null, ?int $page = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/profiles', $params);
    }

    /**
     * Get a single social media profile by ID.
     *
     * @param  string  $profileId  The profile ID.
     * @return array<string, mixed>
     */
    public function getProfile(string $profileId): array
    {
        return $this->request('GET', '/profiles/' . urlencode($profileId));
    }

    /**
     * List posts for a profile or across the account.
     *
     * @param  string|null  $profileId  Filter by profile ID.
     * @param  string|null  $status     Filter by status (e.g., "scheduled", "published", "draft").
     * @param  int|null     $limit      Number of posts to return per page.
     * @param  int|null     $page       Page number for pagination.
     * @return array<string, mixed>
     */
    public function listPosts(
        ?string $profileId = null,
        ?string $status = null,
        ?int $limit = null,
        ?int $page = null,
    ): array {
        $params = [];
        if ($profileId !== null) {
            $params['profile_id'] = $profileId;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/posts', $params);
    }

    /**
     * Create a new post in Later.
     *
     * @param  string       $text          The caption or text content of the post.
     * @param  array        $profileIds    Array of profile IDs to publish to.
     * @param  string|null  $scheduledAt   ISO 8601 timestamp for scheduling.
     * @param  string|null  $mediaUrl      URL of the media to attach.
     * @param  string|null  $mediaType     Type of media (e.g., "image", "video").
     * @param  string|null  $title         Optional title for the post.
     * @return array<string, mixed>
     */
    public function createPost(
        string $text,
        array $profileIds,
        ?string $scheduledAt = null,
        ?string $mediaUrl = null,
        ?string $mediaType = null,
        ?string $title = null,
    ): array {
        $data = [
            'text' => $text,
            'profile_ids' => $profileIds,
        ];

        if ($scheduledAt !== null) {
            $data['scheduled_at'] = $scheduledAt;
        }

        if ($mediaUrl !== null) {
            $data['media_url'] = $mediaUrl;
        }

        if ($mediaType !== null) {
            $data['media_type'] = $mediaType;
        }

        if ($title !== null) {
            $data['title'] = $title;
        }

        return $this->request('POST', '/posts', $data);
    }

    /**
     * List media items in the Later media library.
     *
     * @param  int|null     $limit      Number of items to return per page.
     * @param  int|null     $page       Page number for pagination.
     * @param  string|null  $type       Filter by media type (e.g., "image", "video").
     * @return array<string, mixed>
     */
    public function listMedia(?int $limit = null, ?int $page = null, ?string $type = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/media', $params);
    }

    /**
     * Get a single media item by ID.
     *
     * @param  string  $mediaId  The media item ID.
     * @return array<string, mixed>
     */
    public function getMedia(string $mediaId): array
    {
        return $this->request('GET', '/media/' . urlencode($mediaId));
    }

    /**
     * Get the currently authenticated Later user.
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
     * @param  string  $path    API endpoint path (e.g. "/profiles").
     * @param  array   $data    Query params (GET) or body data (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Later API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Query params or body data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Later access token is not configured.');
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
                    Log::warning("Later API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Later API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Later API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Later API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Later API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Later API: {$e->getMessage()}");
        }
    }
}
