<?php

namespace OpenCompany\Integrations\YouTube\Tools;

use OpenCompany\Integrations\YouTube\YouTubeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List YouTube channels by username, ID, or other filters.
 */
class YouTubeListChannels implements Tool
{
    /** @param  YouTubeService  $service  The YouTube API client */
    public function __construct(
        private YouTubeService $service,
    ) {}

    public function name(): string
    {
        return 'youtube_list_channels';
    }

    public function description(): string
    {
        return 'List YouTube channels by username, channel ID, or category. Returns channel snippets, statistics, and content details.';
    }

    public function parameters(): array
    {
        return [
            'for_username' => ['type' => 'string', 'description' => 'YouTube username to look up channels for.'],
            'channel_ids' => ['type' => 'string', 'description' => 'Comma-separated channel IDs (max 50).'],
            'category_id' => ['type' => 'string', 'description' => 'Guide category ID to filter channels.'],
            'mine' => ['type' => 'boolean', 'description' => 'Set to true to list the authenticated user\'s channel.'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum results per page (1-50). Default: 5.'],
            'page_token' => ['type' => 'string', 'description' => 'Token for the next page of results.'],
            'hl' => ['type' => 'string', 'description' => 'Language code for localized text (e.g., "en", "es").'],
        ];
    }

    /**
     * List YouTube channels.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('YouTube is not configured. Missing API key.');
        }

        // Ensure at least one filter is provided
        $hasFilter = isset($args['for_username']) || isset($args['channel_ids']) || isset($args['category_id']) || !empty($args['mine']);

        if (! $hasFilter) {
            return ToolResult::error('At least one filter is required: for_username, channel_ids, category_id, or mine.');
        }

        try {
            $params = [];

            if (isset($args['for_username'])) {
                $params['forUsername'] = $args['for_username'];
            }
            if (isset($args['channel_ids'])) {
                $params['id'] = $args['channel_ids'];
            }
            if (isset($args['category_id'])) {
                $params['categoryId'] = $args['category_id'];
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
            if (isset($args['hl'])) {
                $params['hl'] = $args['hl'];
            }

            $result = $this->service->listChannels($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
