<?php

namespace OpenCompany\Integrations\YouTube\Tools;

use OpenCompany\Integrations\YouTube\YouTubeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for videos, channels, or playlists on YouTube.
 */
class YouTubeSearchVideos implements Tool
{
    /** @param  YouTubeService  $service  The YouTube API client */
    public function __construct(
        private YouTubeService $service,
    ) {}

    public function name(): string
    {
        return 'youtube_search_videos';
    }

    public function description(): string
    {
        return 'Search for videos, channels, or playlists on YouTube using keywords, filters, and sorting options. Returns matching results with snippet metadata.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query text.'],
            'type' => ['type' => 'string', 'description' => 'Resource type to search for: video, channel, or playlist. Default: video.'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum number of results per page (1-50). Default: 10.'],
            'page_token' => ['type' => 'string', 'description' => 'Token for the next page of results.'],
            'order' => ['type' => 'string', 'description' => 'Sort order: date, rating, relevance, title, videoCount, viewCount. Default: relevance.'],
            'published_after' => ['type' => 'string', 'description' => 'RFC 3339 formatted date-time (e.g., "2024-01-01T00:00:00Z"). Only resources created after this date.'],
            'published_before' => ['type' => 'string', 'description' => 'RFC 3339 formatted date-time. Only resources created before this date.'],
            'region_code' => ['type' => 'string', 'description' => 'ISO 3166-1 alpha-2 country code (e.g., "US").'],
            'channel_id' => ['type' => 'string', 'description' => 'Limit search to a specific channel.'],
            'video_duration' => ['type' => 'string', 'description' => 'Video duration filter: any, long (>20min), medium (4-20min), short (<4min).'],
            'safe_search' => ['type' => 'string', 'description' => 'Safe search level: moderate, none, strict. Default: moderate.'],
        ];
    }

    /**
     * Search for YouTube content using keywords and filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('YouTube is not configured. Missing API key.');
        }

        $query = $args['query'] ?? '';

        if (empty($query)) {
            return ToolResult::error('Search query is required.');
        }

        try {
            $params = ['q' => $query];

            if (isset($args['type'])) {
                $params['type'] = $args['type'];
            }
            if (isset($args['max_results'])) {
                $params['maxResults'] = min(max((int) $args['max_results'], 1), 50);
            }
            if (isset($args['page_token'])) {
                $params['pageToken'] = $args['page_token'];
            }
            if (isset($args['order'])) {
                $params['order'] = $args['order'];
            }
            if (isset($args['published_after'])) {
                $params['publishedAfter'] = $args['published_after'];
            }
            if (isset($args['published_before'])) {
                $params['publishedBefore'] = $args['published_before'];
            }
            if (isset($args['region_code'])) {
                $params['regionCode'] = $args['region_code'];
            }
            if (isset($args['channel_id'])) {
                $params['channelId'] = $args['channel_id'];
            }
            if (isset($args['video_duration']) && ($args['type'] ?? 'video') === 'video') {
                $params['videoDuration'] = $args['video_duration'];
            }
            if (isset($args['safe_search'])) {
                $params['safeSearch'] = $args['safe_search'];
            }

            $result = $this->service->search($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
