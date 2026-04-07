<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

use OpenCompany\Integrations\Pagerduty\PagerdutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Teams.
 *
 * Lists PagerDuty teams with pagination support.
 *
 * @see https://developer.pagerduty.com/api-reference/list-teams
 */
class PagerdutyListTeams implements Tool
{
    /**
     * @param  PagerdutyService  $service  The PagerDuty API service instance.
     */
    public function __construct(
        private PagerdutyService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'pagerduty_list_teams';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List PagerDuty teams. Returns a paginated list of teams with their names, descriptions, and parent team info.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit'  => ['type' => 'integer', 'description' => 'Maximum number of teams to return (default: 25, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the list teams tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $limit  = isset($args['limit']) ? (int) $args['limit'] : 25;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listTeams($limit, $offset);

            $teams = $result['teams'] ?? [];
            $total = $result['total'] ?? count($teams);
            $more  = $result['more'] ?? (($offset + count($teams)) < $total);

            return ToolResult::success([
                'teams'  => $teams,
                'count'  => count($teams),
                'total'  => $total,
                'more'   => $more,
                'offset' => $offset,
                'limit'  => $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
