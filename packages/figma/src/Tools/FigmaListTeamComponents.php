<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List published components in a Figma team.
 *
 * Returns all published components across the team's
 * libraries, with optional depth control.
 */
class FigmaListTeamComponents implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_list_team_components';
    }

    public function description(): string
    {
        return 'List published components in a Figma team.';
    }

    public function parameters(): array
    {
        return [
            'team_id'   => ['type' => 'string', 'required' => true, 'description' => 'The Figma team ID.'],
            'max_depth' => ['type' => 'integer', 'description' => 'Maximum depth of component tree to return.'],
        ];
    }

    /**
     * List published components in a Figma team.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id, max_depth)
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

            $params = [];

            if (isset($args['max_depth'])) {
                $params['max_depth'] = (int) $args['max_depth'];
            }

            $result = $this->service->listTeamComponents($teamId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
