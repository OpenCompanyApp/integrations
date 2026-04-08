<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

use OpenCompany\Integrations\Pagerduty\PagerdutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Incidents.
 *
 * Lists PagerDuty incidents with optional filters for status, urgency,
 * service, and team. Supports pagination via limit and offset.
 *
 * @see https://developer.pagerduty.com/api-reference/list-incidents
 */
class PagerdutyListIncidents implements Tool
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
        return 'pagerduty_list_incidents';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List PagerDuty incidents. Filter by status (triggered, acknowledged, resolved), urgency (high, low), service ID, or team ID. Returns a paginated list of incidents.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'status'     => ['type' => 'string', 'description' => 'Filter by status: "triggered", "acknowledged", or "resolved".'],
            'urgency'    => ['type' => 'string', 'description' => 'Filter by urgency: "high" or "low".'],
            'service_id' => ['type' => 'string', 'description' => 'Filter by service ID.'],
            'team_id'    => ['type' => 'string', 'description' => 'Filter by team ID.'],
            'limit'      => ['type' => 'integer', 'description' => 'Maximum number of incidents to return (default: 25, max: 100).'],
            'offset'     => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the list incidents tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (status, urgency, service_id, team_id, limit, offset).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $status    = $args['status'] ?? null;
            $urgency   = $args['urgency'] ?? null;
            $serviceId = $args['service_id'] ?? null;
            $teamId    = $args['team_id'] ?? null;
            $limit     = isset($args['limit']) ? (int) $args['limit'] : 25;
            $offset    = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listIncidents($status, $urgency, $serviceId, $teamId, $limit, $offset);

            $incidents = $result['incidents'] ?? [];
            $total     = $result['total'] ?? count($incidents);
            $more      = $result['more'] ?? (($offset + count($incidents)) < $total);

            return ToolResult::success([
                'incidents' => $incidents,
                'count'     => count($incidents),
                'total'     => $total,
                'more'      => $more,
                'offset'    => $offset,
                'limit'     => $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
