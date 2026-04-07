<?php

namespace OpenCompany\Integrations\Teams\Tools;

use OpenCompany\Integrations\Teams\TeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a message to a Microsoft Teams channel.
 */
class TeamsSendMessage implements Tool
{
    /**
     * @param  TeamsService  $service  The Microsoft Graph API client
     */
    public function __construct(
        private TeamsService $service,
    ) {}

    public function name(): string
    {
        return 'teams_send_message';
    }

    public function description(): string
    {
        return 'Send a message to a Microsoft Teams channel.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the team.'],
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The message content to send.'],
            'content_type' => ['type' => 'string', 'description' => 'Content type: "text" (default) or "html".'],
        ];
    }

    /**
     * Send a message to a Teams channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id, channel_id, content, content_type)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Microsoft Teams integration is not configured.');
            }

            $teamId = $args['team_id'] ?? '';
            $channelId = $args['channel_id'] ?? '';
            $content = $args['content'] ?? '';

            if (empty($teamId)) {
                return ToolResult::error('team_id is required.');
            }
            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }
            if (empty($content)) {
                return ToolResult::error('content is required.');
            }

            $contentType = $args['content_type'] ?? 'text';

            $data = [
                'body' => [
                    'content' => $content,
                    'contentType' => $contentType,
                ],
            ];

            $result = $this->service->sendMessage($teamId, $channelId, $data);

            return ToolResult::success([
                'ok' => true,
                'message' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
