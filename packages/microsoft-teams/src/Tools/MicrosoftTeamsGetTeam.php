<?php

namespace OpenCompany\Integrations\MicrosoftTeams\Tools;

use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details for a specific Microsoft Teams team.
 *
 * Calls GET /teams/{id} on the Microsoft Graph API and returns the team's
 * properties including displayName, description, and visibility.
 */
class MicrosoftTeamsGetTeam implements Tool
{
    /**
     * Create a new MicrosoftTeamsGetTeam tool instance.
     */
    public function __construct(
        private MicrosoftTeamsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'microsoft_teams_get_team';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a specific Microsoft Teams team by its ID. Returns the team name, description, and other properties.';
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
     * Execute the tool and return the team details.
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

            $result = $this->service->getTeam($args['team_id']);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'displayName' => $result['displayName'] ?? null,
                'description' => $result['description'] ?? null,
                'visibility' => $result['visibility'] ?? null,
                'webUrl' => $result['webUrl'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
