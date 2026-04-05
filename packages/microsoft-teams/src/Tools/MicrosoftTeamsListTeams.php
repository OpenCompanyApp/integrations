<?php

namespace OpenCompany\Integrations\MicrosoftTeams\Tools;

use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all teams the authenticated user has joined in Microsoft Teams.
 *
 * Calls GET /me/joinedTeams on the Microsoft Graph API and returns the team list
 * with id, displayName, and description for each team.
 */
class MicrosoftTeamsListTeams implements Tool
{
    /**
     * Create a new MicrosoftTeamsListTeams tool instance.
     */
    public function __construct(
        private MicrosoftTeamsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'microsoft_teams_list_teams';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all Microsoft Teams teams the authenticated user has joined. Returns team IDs, names, and descriptions.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the list of teams.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft Teams integration is not configured.');
            }

            $result = $this->service->listTeams();

            $teams = $result['value'] ?? [];

            return ToolResult::success([
                'teams' => array_map(function (array $team): array {
                    return [
                        'id' => $team['id'] ?? null,
                        'displayName' => $team['displayName'] ?? null,
                        'description' => $team['description'] ?? null,
                    ];
                }, $teams),
                'totalCount' => count($teams),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
