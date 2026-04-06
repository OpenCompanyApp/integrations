<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a post (message) in a Mattermost channel.
 *
 * Sends a message to the specified channel and returns the created post
 * object including id, create_at, update_at, and the message content.
 */
class MattermostCreatePost implements Tool
{
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_create_post';
    }

    public function description(): string
    {
        return 'Post a message to a Mattermost channel. Provide the channel_id and the message text. Returns the created post with its ID and timestamp.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The channel ID to post the message in.'],
            'message' => ['type' => 'string', 'required' => true, 'description' => 'The message text to post. Supports Markdown formatting.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $channelId = $args['channel_id'] ?? '';
            $message = $args['message'] ?? '';

            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }
            if (empty($message)) {
                return ToolResult::error('message is required.');
            }

            $result = $this->service->createPost($channelId, $message);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
