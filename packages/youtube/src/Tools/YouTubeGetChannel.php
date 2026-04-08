<?php

namespace OpenCompany\Integrations\YouTube\Tools;

use OpenCompany\Integrations\YouTube\YouTubeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific YouTube channel.
 */
class YouTubeGetChannel implements Tool
{
    /** @param  YouTubeService  $service  The YouTube API client */
    public function __construct(
        private YouTubeService $service,
    ) {}

    public function name(): string
    {
        return 'youtube_get_channel';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific YouTube channel by ID, including snippet, statistics (subscribers, views, videos), content details, and branding settings.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The YouTube channel ID (e.g., "UC_x5XG1OV2P6uZZ5FSM9Ttw").'],
            'part' => ['type' => 'string', 'description' => 'Comma-separated resource parts. Default: snippet,contentDetails,statistics,brandingSettings.'],
        ];
    }

    /**
     * Get channel details by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('YouTube is not configured. Missing API key.');
        }

        $channelId = $args['channel_id'] ?? '';

        if (empty($channelId)) {
            return ToolResult::error('Channel ID is required.');
        }

        try {
            $part = $args['part'] ?? 'snippet,contentDetails,statistics,brandingSettings';

            $result = $this->service->getChannel($channelId, $part);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
