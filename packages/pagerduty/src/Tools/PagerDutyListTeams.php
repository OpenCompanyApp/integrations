<?php

namespace OpenCompany\Integrations\PagerDuty\Tools;

use OpenCompany\Integrations\PagerDuty\PagerDutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List PagerDuty teams with optional pagination.
 *
 * Returns team details including name, description, and parent team.
 */
class PagerDutyListTeams implements Tool
{
    /**
     * @param  PagerDutyService  $service  The PagerDuty API client
     */
    public function __construct(
        private PagerDutyService $service,
    ) {}

    public function name(): string
    {
        return 'pagerduty_list_teams';
    }

    public function description(): string
    {
        return <<<'MD'
        List PagerDuty teams with optional pagination.
        Returns team details including name, description, and parent team.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of teams to return (1–100, default 25).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default 0).'],
        ];
    }

    /**
     * List PagerDuty teams with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listTeams($params);

            $teams = array_map(function (array $team) {
                return [
                    'id' => $team['id'] ?? '',
                    'name' => $team['name'] ?? '',
                    'description' => $team['description'] ?? null,
                    'parent' => isset($team['parent']) ? [
                        'id' => $team['parent']['id'] ?? '',
                        'name' => $team['parent']['summary'] ?? '',
                    ] : null,
                    'html_url' => $team['html_url'] ?? '',
                ];
            }, $result['teams'] ?? []);

            return ToolResult::success([
                'teams' => $teams,
                'total' => $result['total'] ?? count($teams),
                'more' => $result['more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
