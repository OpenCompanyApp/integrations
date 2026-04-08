<?php

namespace OpenCompany\Integrations\YouTube\Tools;

use OpenCompany\Integrations\YouTube\YouTubeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about one or more YouTube videos.
 */
class YouTubeGetVideoDetails implements Tool
{
    /** @param  YouTubeService  $service  The YouTube API client */
    public function __construct(
        private YouTubeService $service,
    ) {}

    public function name(): string
    {
        return 'youtube_get_video_details';
    }

    public function description(): string
    {
        return 'Get detailed information about one or more YouTube videos by ID, including title, description, thumbnails, duration, view count, likes, and channel info.';
    }

    public function parameters(): array
    {
        return [
            'video_ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated YouTube video IDs (e.g., "dQw4w9WgXcQ") or a single video ID. Max 50 IDs.'],
            'part' => ['type' => 'string', 'description' => 'Comma-separated resource parts to include. Default: snippet,contentDetails,statistics. Options: snippet, contentDetails, statistics, status, topicDetails, recordingDetails, fileDetails, processingDetails, suggestions, liveStreamingDetails, localizations.'],
        ];
    }

    /**
     * Get video details by ID(s).
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('YouTube is not configured. Missing API key.');
        }

        $videoIds = $args['video_ids'] ?? '';

        if (empty($videoIds)) {
            return ToolResult::error('Video ID(s) are required.');
        }

        try {
            $ids = array_map('trim', explode(',', $videoIds));

            if (count($ids) > 50) {
                return ToolResult::error('Maximum 50 video IDs allowed per request.');
            }

            $part = $args['part'] ?? 'snippet,contentDetails,statistics';

            $result = $this->service->getVideoDetails($ids, $part);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
