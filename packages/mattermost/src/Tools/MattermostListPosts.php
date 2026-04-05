<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List posts in a Mattermost channel.
 *
 * Supports pagination via page and per_page parameters.
 */
class MattermostListPosts implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
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
        return 'List posts in a Mattermost channel. Supports pagination with page and per_page.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel to list posts from.'],
            'page'       => ['type' => 'integer', 'description' => 'The page number to retrieve (0-indexed, default 0).'],
            'per_page'   => ['type' => 'integer', 'description' => 'Number of posts per page (default 60).'],
        ];
    }

    /**
     * List posts in a Mattermost channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel_id, page, per_page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $channelId = $args['channel_id'] ?? '';

            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listPosts($channelId, $params);

            return ToolResult::success([
                'ok' => true,
                'posts' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
