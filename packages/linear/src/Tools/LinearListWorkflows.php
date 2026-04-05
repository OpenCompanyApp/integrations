<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List workflow states for a Linear team, showing available issue statuses.
 */
class LinearListWorkflows implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_list_workflows';
    }

    public function description(): string
    {
        return <<<'MD'
        List workflow states for a Linear team. Shows all available statuses
        (e.g., Backlog, Todo, In Progress, Done) with their IDs, types, and colors.
        Optionally filter by team ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'description' => 'Team ID to filter workflow states by.'],
        ];
    }

    /**
     * List workflow states, optionally filtered by team.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $teamId = $args['team_id'] ?? null;

            $result = $this->service->listWorkflowStates($teamId);
            $states = $result['data']['workflowStates']['nodes'] ?? [];

            $nodes = array_map(function (array $state) {
                return [
                    'id' => $state['id'] ?? '',
                    'name' => $state['name'] ?? '',
                    'type' => $state['type'] ?? '',
                    'color' => $state['color'] ?? '',
                    'team' => isset($state['team']) ? $state['team']['name'] : null,
                ];
            }, $states);

            return ToolResult::success([
                'workflow_states' => $nodes,
                'total' => count($nodes),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
