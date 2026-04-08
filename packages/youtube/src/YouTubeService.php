<?php

namespace OpenCompany\Integrations\YouTube;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the YouTube Data API v3.
 *
 * Authentication uses an API key passed as a query parameter (key=...).
 * Base URL: https://www.googleapis.com/youtube/v3
 */
class YouTubeService
{
    private const BASE_URL = 'https://www.googleapis.com/youtube/v3';

    /**
     * @param  string  $apiKey  YouTube Data API v3 key
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the YouTube API key has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /*-----------------------------------------------------------------------
     | Search
     *---------------------------------------------------------------------*/

    /**
     * Search for videos, channels, or playlists on YouTube.
     *
     * @param  array<string, mixed>  $params  Query parameters (q, type, maxResults, pageToken, order, publishedAfter, publishedBefore, regionCode, relevanceLanguage, safeSearch, videoCaption, videoCategoryId, videoDefinition, videoDuration, videoEmbeddable, videoLicense, videoSyndicated, channelId, channelType, eventType, location, locationRadius, topicId, forMine, relatedToVideoId)
     * @return array<string, mixed>
     */
    public function search(array $params): array
    {
        $defaults = [
            'part' => 'snippet',
            'type' => 'video',
        ];

        return $this->request('GET', '/search', array_merge($defaults, $params));
    }

    /*-----------------------------------------------------------------------
     | Videos
     *---------------------------------------------------------------------*/

    /**
     * Get details for one or more videos by ID.
     *
     * @param  string|array<int, string>  $ids  A single video ID or array of video IDs (max 50)
     * @param  string  $part  Comma-separated part names (default: snippet,contentDetails,statistics)
     * @return array<string, mixed>
     */
    public function getVideoDetails(string|array $ids, string $part = 'snippet,contentDetails,statistics'): array
    {
        $id = is_array($ids) ? implode(',', $ids) : $ids;

        return $this->request('GET', '/videos', [
            'id' => $id,
            'part' => $part,
        ]);
    }

    /*-----------------------------------------------------------------------
     | Channels
     *---------------------------------------------------------------------*/

    /**
     * List channels with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (forUsername, id, categoryId, maxResults, pageToken, mine, hl)
     * @return array<string, mixed>
     */
    public function listChannels(array $params = []): array
    {
        $defaults = [
            'part' => 'snippet,contentDetails,statistics',
        ];

        return $this->request('GET', '/channels', array_merge($defaults, $params));
    }

    /**
     * Get details for a specific channel by ID.
     *
     * @param  string  $channelId  The YouTube channel ID
     * @param  string  $part  Comma-separated part names (default: snippet,contentDetails,statistics,brandingSettings)
     * @return array<string, mixed>
     */
    public function getChannel(string $channelId, string $part = 'snippet,contentDetails,statistics,brandingSettings'): array
    {
        return $this->request('GET', '/channels', [
            'id' => $channelId,
            'part' => $part,
        ]);
    }

    /*-----------------------------------------------------------------------
     | Playlists
     *---------------------------------------------------------------------*/

    /**
     * List playlists for a channel or by ID.
     *
     * @param  array<string, mixed>  $params  Query parameters (channelId, id, maxResults, pageToken, mine)
     * @return array<string, mixed>
     */
    public function listPlaylists(array $params = []): array
    {
        $defaults = [
            'part' => 'snippet,contentDetails',
        ];

        return $this->request('GET', '/playlists', array_merge($defaults, $params));
    }

    /**
     * Get details for a specific playlist by ID.
     *
     * @param  string  $playlistId  The YouTube playlist ID
     * @param  string  $part  Comma-separated part names (default: snippet,contentDetails,status)
     * @return array<string, mixed>
     */
    public function getPlaylist(string $playlistId, string $part = 'snippet,contentDetails,status'): array
    {
        return $this->request('GET', '/playlists', [
            'id' => $playlistId,
            'part' => $part,
        ]);
    }

    /*-----------------------------------------------------------------------
     | Playlist Items
     *---------------------------------------------------------------------*/

    /**
     * List items in a playlist.
     *
     * @param  string  $playlistId  The YouTube playlist ID
     * @param  array<string, mixed>  $params  Query parameters (maxResults, pageToken, videoCategoryId)
     * @return array<string, mixed>
     */
    public function listPlaylistItems(string $playlistId, array $params = []): array
    {
        $defaults = [
            'part' => 'snippet,contentDetails',
            'playlistId' => $playlistId,
        ];

        return $this->request('GET', '/playlistItems', array_merge($defaults, $params));
    }

    /*-----------------------------------------------------------------------
     | User
     *---------------------------------------------------------------------*/

    /**
     * Get the authenticated user's channel.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/channels', [
            'part' => 'snippet,contentDetails,statistics',
            'mine' => 'true',
        ]);
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    /**
     * Make an authenticated API request to YouTube Data API v3.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('YouTube API key is not configured.');
        }

        // YouTube Data API uses key as a query parameter
        $params['key'] = $this->apiKey;

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Accept' => 'application/json',
            ])->timeout(30);

            $url = self::BASE_URL . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 403) {
                $body = $response->json() ?? [];
                $reason = $body['error']['errors'][0]['reason'] ?? 'unknown';
                $message = $body['error']['message'] ?? $response->body();

                if ($reason === 'quotaExceeded' || $reason === 'rateLimitExceeded') {
                    throw new \RuntimeException("YouTube API quota exceeded: {$message}");
                }

                Log::error("YouTube API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'reason' => $reason,
                    'error' => $message,
                ]);

                throw new \RuntimeException("YouTube API error ({$response->status()}): " . (is_string($message) ? $message : json_encode($message)));
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error']['message'] ?? $response->body();

                Log::error("YouTube API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'YouTube API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("YouTube API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to YouTube API: {$e->getMessage()}");
        }
    }
}
