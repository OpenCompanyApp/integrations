<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List projects in a Figma team.
 *
 * Returns all projects belonging to the specified team.
 */
class FigmaGetTeamProjects implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_get_team_projects';
    }

    public function description(): string
    {
        return 'List all projects in a Figma team.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The Figma team ID.'],
        ];
    }

    /**
     * List projects in a Figma team.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Figma integration is not configured.');
            }

            $teamId = $args['team_id'] ?? '';

            if (empty($teamId)) {
                return ToolResult::error('team_id is required.');
            }

            $result = $this->service->getTeamProjects($teamId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
