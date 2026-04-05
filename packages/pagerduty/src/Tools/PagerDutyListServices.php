<?php

namespace OpenCompany\Integrations\PagerDuty\Tools;

use OpenCompany\Integrations\PagerDuty\PagerDutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List PagerDuty services with optional filtering and pagination.
 *
 * Supports filtering by team IDs. Returns service details including
 * status, escalation policy, and integration counts.
 */
class PagerDutyListServices implements Tool
{
    /**
     * @param  PagerDutyService  $service  The PagerDuty API client
     */
    public function __construct(
        private PagerDutyService $service,
    ) {}

    public function name(): string
    {
        return 'pagerduty_list_services';
    }

    public function description(): string
    {
        return <<<'MD'
        List PagerDuty services with optional filtering by team.
        Supports pagination with limit and offset.
        Returns service details including status, escalation policy, and integrations.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of services to return (1–100, default 25).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default 0).'],
            'team_ids' => ['type' => 'array', 'description' => 'Filter by team IDs (array of team ID strings).'],
        ];
    }

    /**
     * List PagerDuty services with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, team_ids)
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
            if (isset($args['team_ids']) && is_array($args['team_ids'])) {
                foreach ($args['team_ids'] as $i => $teamId) {
                    $params["team_ids[]"][$i] = $teamId;
                }
            }

            $result = $this->service->listServices($params);

            $services = array_map(function (array $svc) {
                return [
                    'id' => $svc['id'] ?? '',
                    'name' => $svc['name'] ?? '',
                    'status' => $svc['status'] ?? '',
                    'description' => $svc['description'] ?? null,
                    'created_at' => $svc['created_at'] ?? null,
                    'updated_at' => $svc['updated_at'] ?? null,
                    'escalation_policy' => [
                        'id' => $svc['escalation_policy']['id'] ?? '',
                        'name' => $svc['escalation_policy']['summary'] ?? '',
                    ],
                    'teams' => array_map(function (array $t) {
                        return [
                            'id' => $t['id'] ?? '',
                            'name' => $t['summary'] ?? '',
                        ];
                    }, $svc['teams'] ?? []),
                    'html_url' => $svc['html_url'] ?? '',
                ];
            }, $result['services'] ?? []);

            return ToolResult::success([
                'services' => $services,
                'total' => $result['total'] ?? count($services),
                'more' => $result['more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
