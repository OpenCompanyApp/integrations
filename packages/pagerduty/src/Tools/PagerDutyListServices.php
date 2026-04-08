<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

use OpenCompany\Integrations\Pagerduty\PagerdutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Services.
 *
 * Lists PagerDuty services with optional team filtering and pagination.
 *
 * @see https://developer.pagerduty.com/api-reference/list-services
 */
class PagerdutyListServices implements Tool
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
        return 'pagerduty_list_services';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List PagerDuty services. Optionally filter by team ID. Returns a paginated list of services with status and escalation policy info.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'description' => 'Filter services by team ID.'],
            'limit'   => ['type' => 'integer', 'description' => 'Maximum number of services to return (default: 25, max: 100).'],
            'offset'  => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the list services tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id, limit, offset).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $teamId = $args['team_id'] ?? null;
            $limit  = isset($args['limit']) ? (int) $args['limit'] : 25;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listServices($teamId, $limit, $offset);

            $services = $result['services'] ?? [];
            $total    = $result['total'] ?? count($services);
            $more     = $result['more'] ?? (($offset + count($services)) < $total);

            return ToolResult::success([
                'services' => $services,
                'count'    => count($services),
                'total'    => $total,
                'more'     => $more,
                'offset'   => $offset,
                'limit'    => $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
