<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_get_team
 *
 * Get details for a single Teamwork team.
 */
class TeamworkGetTeam implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_get_team';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Teamwork team, including members and settings.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'integer', 'required' => true, 'description' => 'The team ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $result = $this->service->getTeam((int) $args['team_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
