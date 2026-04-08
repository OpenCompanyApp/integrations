<?php

namespace OpenCompany\Integrations\MicrosoftTeams\Tools;

use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details for a specific Microsoft Teams channel.
 *
 * Calls GET /teams/{id}/channels/{cid} on the Microsoft Graph API and returns
 * the channel's properties including displayName, description, and membershipType.
 */
class MicrosoftTeamsGetChannel implements Tool
{
    /**
     * Create a new MicrosoftTeamsGetChannel tool instance.
     */
    public function __construct(
        private MicrosoftTeamsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'microsoft_teams_get_channel';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a specific Microsoft Teams channel by its team and channel ID.';
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
        ];
    }

    /**
     * Execute the tool and return the channel details.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing 'team_id' and 'channel_id'.
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

            $result = $this->service->getChannel($args['team_id'], $args['channel_id']);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'displayName' => $result['displayName'] ?? null,
                'description' => $result['description'] ?? null,
                'membershipType' => $result['membershipType'] ?? null,
                'webUrl' => $result['webUrl'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
