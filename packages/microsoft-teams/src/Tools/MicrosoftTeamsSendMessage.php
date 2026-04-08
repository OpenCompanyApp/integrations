<?php

namespace OpenCompany\Integrations\MicrosoftTeams\Tools;

use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to send a message to a Microsoft Teams channel.
 *
 * Calls POST /teams/{id}/channels/{cid}/messages on the Microsoft Graph API
 * with the specified content. Supports plain text and HTML content types.
 */
class MicrosoftTeamsSendMessage implements Tool
{
    /**
     * Create a new MicrosoftTeamsSendMessage tool instance.
     */
    public function __construct(
        private MicrosoftTeamsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'microsoft_teams_send_message';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Send a message to a Microsoft Teams channel. Supports plain text and HTML content.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the team.'],
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the channel.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The message content to send.'],
            'content_type' => ['type' => 'string', 'description' => 'The content type: "text" or "html". Defaults to "text".'],
        ];
    }

    /**
     * Execute the tool and send the message.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing 'team_id', 'channel_id', 'content', and optional 'content_type'.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft Teams integration is not configured.');
            }

            if (empty($args['team_id'])) {
                return ToolResult::error('team_id is required.');
            }

            if (empty($args['channel_id'])) {
                return ToolResult::error('channel_id is required.');
            }

            if (empty($args['content'])) {
                return ToolResult::error('content is required.');
            }

            $contentType = $args['content_type'] ?? 'text';

            if (!in_array($contentType, ['text', 'html'], true)) {
                return ToolResult::error('content_type must be "text" or "html".');
            }

            $result = $this->service->sendMessage(
                $args['team_id'],
                $args['channel_id'],
                $args['content'],
                $contentType,
            );

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'createdDateTime' => $result['createdDateTime'] ?? null,
                'webUrl' => $result['webUrl'] ?? null,
                'message' => 'Message sent successfully.',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
