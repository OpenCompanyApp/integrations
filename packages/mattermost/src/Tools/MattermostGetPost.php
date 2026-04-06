<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Mattermost post by ID.
 *
 * Returns the full post object including id, create_at, update_at,
 * message, channel_id, user_id, and any metadata or attachments.
 */
class MattermostGetPost implements Tool
{
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_get_post';
    }

    public function description(): string
    {
        return 'Get a specific Mattermost post by ID. Returns the full post including message content, author, channel, and timestamps.';
    }

    public function parameters(): array
    {
        return [
            'post_id' => ['type' => 'string', 'required' => true, 'description' => 'The post ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $postId = $args['post_id'] ?? '';
            if (empty($postId)) {
                return ToolResult::error('post_id is required.');
            }

            $result = $this->service->getPost($postId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
