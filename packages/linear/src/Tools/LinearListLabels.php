<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List issue labels in Linear, optionally filtered by team.
 */
class LinearListLabels implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_list_labels';
    }

    public function description(): string
    {
        return <<<'MD'
        List issue labels in Linear. Optionally filter by team.
        Returns label ID, name, color, and description.
        MD;
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'description' => 'Team ID to filter labels by.'],
        ];
    }

    /**
     * List Linear issue labels, optionally filtered by team.
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

            $result = $this->service->listLabels($teamId);
            $labels = $result['data']['issueLabels']['nodes'] ?? [];

            $nodes = array_map(function (array $label) {
                return [
                    'id' => $label['id'] ?? '',
                    'name' => $label['name'] ?? '',
                    'color' => $label['color'] ?? '',
                    'description' => $label['description'] ?? '',
                    'team' => isset($label['team']) ? $label['team']['name'] : null,
                ];
            }, $labels);

            return ToolResult::success([
                'labels' => $nodes,
                'total' => count($nodes),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
