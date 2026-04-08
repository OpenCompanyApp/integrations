<?php

namespace OpenCompany\Integrations\YouTube\Tools;

use OpenCompany\Integrations\YouTube\YouTubeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List playlists for a YouTube channel.
 */
class YouTubeListPlaylists implements Tool
{
    /** @param  YouTubeService  $service  The YouTube API client */
    public function __construct(
        private YouTubeService $service,
    ) {}

    public function name(): string
    {
        return 'youtube_list_playlists';
    }

    public function description(): string
    {
        return 'List playlists for a YouTube channel or by playlist IDs. Returns playlist snippets and content details.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'description' => 'YouTube channel ID to list playlists for.'],
            'playlist_ids' => ['type' => 'string', 'description' => 'Comma-separated playlist IDs to look up (max 50).'],
            'mine' => ['type' => 'boolean', 'description' => 'Set to true to list the authenticated user\'s playlists.'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum results per page (1-50). Default: 5.'],
            'page_token' => ['type' => 'string', 'description' => 'Token for the next page of results.'],
        ];
    }

    /**
     * List playlists for a channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('YouTube is not configured. Missing API key.');
        }

        $hasFilter = isset($args['channel_id']) || isset($args['playlist_ids']) || !empty($args['mine']);

        if (! $hasFilter) {
            return ToolResult::error('At least one filter is required: channel_id, playlist_ids, or mine.');
        }

        try {
            $params = [];

            if (isset($args['channel_id'])) {
                $params['channelId'] = $args['channel_id'];
            }
            if (isset($args['playlist_ids'])) {
                $params['id'] = $args['playlist_ids'];
            }
            if (!empty($args['mine'])) {
                $params['mine'] = 'true';
            }
            if (isset($args['max_results'])) {
                $params['maxResults'] = min(max((int) $args['max_results'], 1), 50);
            }
            if (isset($args['page_token'])) {
                $params['pageToken'] = $args['page_token'];
            }

            $result = $this->service->listPlaylists($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
