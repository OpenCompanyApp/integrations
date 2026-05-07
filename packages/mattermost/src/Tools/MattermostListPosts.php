<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List posts in a Mattermost channel.
 *
 * Returns a collection of posts from the specified channel, including
 * post IDs, message content, author user IDs, and timestamps.
 */
class MattermostListPosts implements Tool
{
    /**
     * @param  MattermostService  $service  Mattermost API client.
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_list_posts';
    }

    public function description(): string
    {
        return 'List posts in a Mattermost channel. Returns post IDs, messages, author info, and timestamps. Use page and per_page for pagination.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The channel ID to list posts from.'],
            'page' => ['type' => 'integer', 'description' => 'Page number (0-indexed). Default: 0.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of posts per page. Default: 60.'],
        ];
    }

    /**
     * List posts in a Mattermost channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $channelId = $args['channel_id'] ?? '';
            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 0;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 60;

            $result = $this->service->listPosts($channelId, $page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
