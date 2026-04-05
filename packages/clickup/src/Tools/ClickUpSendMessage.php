<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpSendMessage implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_send_message';
    }

    public function description(): string
    {
        return 'Send a message to a ClickUp chat channel.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'Message content, supports markdown.'],
            'content_format' => ['type' => 'string', 'description' => 'Content format: "text/md" (default) or "text/plain".'],
            'type' => ['type' => 'string', 'description' => 'Message type: "message" (default) or "post".'],
            'post_title' => ['type' => 'string', 'description' => 'Post title (required if type is "post").'],
            'workspace_id' => ['type' => 'string', 'description' => 'Workspace ID. Uses configured default if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();
            if (empty($workspaceId)) {
                return ToolResult::error('Workspace ID is required. Configure it in settings or pass workspace_id.');
            }

            $channelId = $args['channel_id'] ?? '';
            $content = $args['content'] ?? '';

            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }
            if (empty($content)) {
                return ToolResult::error('content is required.');
            }

            $data = [
                'content' => $content,
                'content_format' => $args['content_format'] ?? 'text/md',
            ];

            if (isset($args['type']) && $args['type'] === 'post') {
                $data['type'] = 'post';
                if (isset($args['post_title'])) {
                    $data['post_title'] = $args['post_title'];
                }
            }

            $result = $this->service->sendChatMessage($workspaceId, $channelId, $data);

            return ToolResult::success(['id' => $result['id'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
