<?php

namespace OpenCompany\Integrations\Instagram;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://graph.instagram.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List media published by the Instagram user.
     *
     * @param  int|null   $limit   Number of media items to return.
     * @param  string|null $after  Cursor for pagination (after).
     * @param  string|null $before Cursor for pagination (before).
     * @param  string|null $fields Comma-separated fields to return.
     * @return array<string, mixed>
     */
    public function listMedia(?int $limit = null, ?string $after = null, ?string $before = null, ?string $fields = null): array
    {
        $params = [];

        if ($fields !== null) {
            $params['fields'] = $fields;
        } else {
            $params['fields'] = 'id,caption,media_type,media_url,permalink,timestamp,username';
        }

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($after !== null) {
            $params['after'] = $after;
        }

        if ($before !== null) {
            $params['before'] = $before;
        }

        return $this->request('GET', '/me/media', $params);
    }

    /**
     * Get a single media item by ID.
     *
     * @param  string $mediaId The media ID.
     * @param  string|null $fields Comma-separated fields to return.
     * @return array<string, mixed>
     */
    public function getMedia(string $mediaId, ?string $fields = null): array
    {
        $params = [];

        if ($fields !== null) {
            $params['fields'] = $fields;
        } else {
            $params['fields'] = 'id,caption,media_type,media_url,permalink,timestamp,username,like_count,comments_count';
        }

        return $this->request('GET', '/' . urlencode($mediaId), $params);
    }

    /**
     * Create a new media item (publish or container).
     *
     * @param  string      $imageUrl   URL of the image or video to publish.
     * @param  string|null $caption    Caption text for the media.
     * @param  string|null $mediaType  Type of media (e.g. "IMAGE", "VIDEO", "CAROUSEL").
     * @param  bool        $publish    Whether to publish immediately (default true).
     * @return array<string, mixed>
     */
    public function createMedia(string $imageUrl, ?string $caption = null, ?string $mediaType = null, bool $publish = true): array
    {
        $data = [
            'image_url' => $imageUrl,
        ];

        if ($caption !== null) {
            $data['caption'] = $caption;
        }

        if ($mediaType !== null) {
            $data['media_type'] = $mediaType;
        }

        // Step 1: Create a container
        $container = $this->request('POST', '/me/media', $data);
        $containerId = $container['id'] ?? null;

        if (!$containerId) {
            throw new \RuntimeException('Failed to create media container.');
        }

        if (!$publish) {
            return $container;
        }

        // Step 2: Publish the container
        return $this->request('POST', '/me/media_publish', [
            'creation_id' => $containerId,
        ]);
    }

    /**
     * List comments on a media item.
     *
     * @param  string   $mediaId The media ID.
     * @param  int|null $limit   Number of comments to return.
     * @param  string|null $after Cursor for pagination.
     * @return array<string, mixed>
     */
    public function listComments(string $mediaId, ?int $limit = null, ?string $after = null): array
    {
        $params = [
            'fields' => 'id,text,timestamp,username,like_count',
        ];

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($after !== null) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/' . urlencode($mediaId) . '/comments', $params);
    }

    /**
     * Get a single comment by ID.
     *
     * @param  string $commentId The comment ID.
     * @return array<string, mixed>
     */
    public function getComment(string $commentId): array
    {
        return $this->request('GET', '/' . urlencode($commentId), [
            'fields' => 'id,text,timestamp,username,like_count',
        ]);
    }

    /**
     * List insights (metrics) for the Instagram user account.
     *
     * @param  string|null $metric  Comma-separated metrics to retrieve.
     * @param  string|null $period  Aggregation period: "day", "week", "days_28", "lifetime".
     * @param  string|null $since   Start date (UNIX timestamp or ISO date).
     * @param  string|null $until   End date (UNIX timestamp or ISO date).
     * @return array<string, mixed>
     */
    public function listInsights(?string $metric = null, ?string $period = null, ?string $since = null, ?string $until = null): array
    {
        $params = [
            'metric' => $metric ?? 'impressions,reach,profile_views,follower_count,email_contacts,phone_call_clicks,text_message_clicks,get_directions_clicks,website_clicks',
        ];

        if ($period !== null) {
            $params['period'] = $period;
        } else {
            $params['period'] = 'day';
        }

        if ($since !== null) {
            $params['since'] = $since;
        }

        if ($until !== null) {
            $params['until'] = $until;
        }

        return $this->request('GET', '/me/insights', $params);
    }

    /**
     * Get the currently authenticated Instagram user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me', [
            'fields' => 'id,username,name,account_type,media_count,followers_count,follows_count,profile_picture_url',
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Query params (GET) or body data (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Instagram Graph API.
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
            throw new \RuntimeException('Instagram access token is not configured.');
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
                    Log::warning("Instagram API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Instagram API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error.message') ?? $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Instagram API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Instagram API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Instagram API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Instagram API: {$e->getMessage()}");
        }
    }
}
