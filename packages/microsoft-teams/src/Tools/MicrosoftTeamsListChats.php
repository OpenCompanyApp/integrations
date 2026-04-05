<?php

namespace OpenCompany\Integrations\MicrosoftTeams\Tools;

use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list chats for the authenticated user in Microsoft Teams.
 *
 * Calls GET /me/chats on the Microsoft Graph API and returns the chat list
 * with id, topic, and chat type for each chat.
 */
class MicrosoftTeamsListChats implements Tool
{
    /**
     * Create a new MicrosoftTeamsListChats tool instance.
     */
    public function __construct(
        private MicrosoftTeamsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'microsoft_teams_list_chats';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List chats for the authenticated Microsoft Teams user. Returns chat IDs, topics, and types (one-to-one, group, or meeting).';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of chats to return (default: 50, max: 50).'],
        ];
    }

    /**
     * Execute the tool and return the list of chats.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing optional 'limit'.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft Teams integration is not configured.');
            }

            $limit = min(isset($args['limit']) ? (int) $args['limit'] : 50, 50);

            $result = $this->service->listChats($limit);

            $chats = $result['value'] ?? [];

            return ToolResult::success([
                'chats' => array_map(function (array $chat): array {
                    return [
                        'id' => $chat['id'] ?? null,
                        'topic' => $chat['topic'] ?? null,
                        'chatType' => $chat['chatType'] ?? null,
                        'createdDateTime' => $chat['createdDateTime'] ?? null,
                        'lastUpdatedDateTime' => $chat['lastUpdatedDateTime'] ?? null,
                        'webUrl' => $chat['webUrl'] ?? null,
                    ];
                }, $chats),
                'totalCount' => count($chats),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
