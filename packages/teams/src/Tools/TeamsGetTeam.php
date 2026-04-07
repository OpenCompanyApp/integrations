<?php

namespace OpenCompany\Integrations\Teams\Tools;

use OpenCompany\Integrations\Teams\TeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Microsoft Team.
 */
class TeamsGetTeam implements Tool
{
    /**
     * @param  TeamsService  $service  The Microsoft Graph API client
     */
    public function __construct(
        private TeamsService $service,
    ) {}

    public function name(): string
    {
        return 'teams_get_team';
    }

    public function description(): string
    {
        return 'Get detailed information about a Microsoft Team.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the team.'],
        ];
    }

    /**
     * Get team info by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Microsoft Teams integration is not configured.');
            }

            $teamId = $args['team_id'] ?? '';

            if (empty($teamId)) {
                return ToolResult::error('team_id is required.');
            }

            $result = $this->service->getTeam($teamId);

            return ToolResult::success([
                'ok' => true,
                'team' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
