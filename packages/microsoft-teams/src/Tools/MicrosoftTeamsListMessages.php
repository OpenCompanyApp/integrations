<?php

namespace OpenCompany\Integrations\MicrosoftTeams\Tools;

use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list recent messages in a Microsoft Teams channel.
 *
 * Calls GET /teams/{id}/channels/{cid}/messages on the Microsoft Graph API
 * and returns a list of messages with sender info and content.
 */
class MicrosoftTeamsListMessages implements Tool
{
    /**
     * Create a new MicrosoftTeamsListMessages tool instance.
     */
    public function __construct(
        private MicrosoftTeamsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'microsoft_teams_list_messages';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List recent messages in a Microsoft Teams channel. Returns message content, sender info, and timestamps.';
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
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return (default: 50, max: 50).'],
        ];
    }

    /**
     * Execute the tool and return the list of messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing 'team_id', 'channel_id', and optional 'limit'.
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

            $limit = min(isset($args['limit']) ? (int) $args['limit'] : 50, 50);

            $result = $this->service->listMessages($args['team_id'], $args['channel_id'], $limit);

            $messages = $result['value'] ?? [];

            return ToolResult::success([
                'messages' => array_map(function (array $msg): array {
                    $from = $msg['from'] ?? [];
                    $user = $from['user'] ?? [];
                    $body = $msg['body'] ?? [];

                    return [
                        'id' => $msg['id'] ?? null,
                        'createdDateTime' => $msg['createdDateTime'] ?? null,
                        'sender' => [
                            'id' => $user['id'] ?? null,
                            'displayName' => $user['displayName'] ?? null,
                        ],
                        'content' => $body['content'] ?? null,
                        'contentType' => $body['contentType'] ?? null,
                    ];
                }, $messages),
                'totalCount' => count($messages),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
