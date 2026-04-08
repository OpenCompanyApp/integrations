<?php

namespace OpenCompany\Integrations\MicrosoftTeams\Tools;

use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all channels in a Microsoft Teams team.
 *
 * Calls GET /teams/{id}/channels on the Microsoft Graph API and returns the
 * channel list with id, displayName, and description for each channel.
 */
class MicrosoftTeamsListChannels implements Tool
{
    /**
     * Create a new MicrosoftTeamsListChannels tool instance.
     */
    public function __construct(
        private MicrosoftTeamsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'microsoft_teams_list_channels';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all channels in a Microsoft Teams team. Returns channel IDs, names, and descriptions.';
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
        ];
    }

    /**
     * Execute the tool and return the list of channels.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing 'team_id'.
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

            $result = $this->service->listChannels($args['team_id']);

            $channels = $result['value'] ?? [];

            return ToolResult::success([
                'channels' => array_map(function (array $channel): array {
                    return [
                        'id' => $channel['id'] ?? null,
                        'displayName' => $channel['displayName'] ?? null,
                        'description' => $channel['description'] ?? null,
                        'membershipType' => $channel['membershipType'] ?? null,
                    ];
                }, $channels),
                'totalCount' => count($channels),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
