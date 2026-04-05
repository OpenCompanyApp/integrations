<?php

namespace OpenCompany\Integrations\PagerDuty\Tools;

use OpenCompany\Integrations\PagerDuty\PagerDutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List PagerDuty incidents with optional filtering and pagination.
 *
 * Supports filtering by status, service IDs, and urgency. Returns
 * paginated incident records with key details.
 */
class PagerDutyListIncidents implements Tool
{
    /**
     * @param  PagerDutyService  $service  The PagerDuty API client
     */
    public function __construct(
        private PagerDutyService $service,
    ) {}

    public function name(): string
    {
        return 'pagerduty_list_incidents';
    }

    public function description(): string
    {
        return <<<'MD'
        List PagerDuty incidents with optional filtering.
        Supports filtering by status (triggered, acknowledged, resolved),
        service IDs, and urgency (high, low).
        Returns paginated results with incident details.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of incidents to return (1–100, default 25).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default 0).'],
            'status' => ['type' => 'array', 'description' => 'Filter by incident status. Values: "triggered", "acknowledged", "resolved".'],
            'service_ids' => ['type' => 'array', 'description' => 'Filter by service IDs (array of service ID strings).'],
            'urgency' => ['type' => 'string', 'description' => 'Filter by urgency. Values: "high", "low".'],
        ];
    }

    /**
     * List PagerDuty incidents with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, status, service_ids, urgency)
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
            if (isset($args['status']) && is_array($args['status'])) {
                foreach ($args['status'] as $i => $status) {
                    $params["statuses[]"][$i] = $status;
                }
            }
            if (isset($args['service_ids']) && is_array($args['service_ids'])) {
                foreach ($args['service_ids'] as $i => $serviceId) {
                    $params["service_ids[]"][$i] = $serviceId;
                }
            }
            if (isset($args['urgency'])) {
                $params['urgencies[]'] = $args['urgency'];
            }

            $result = $this->service->listIncidents($params);

            $incidents = array_map(function (array $inc) {
                return [
                    'id' => $inc['id'] ?? '',
                    'title' => $inc['title'] ?? '',
                    'status' => $inc['status'] ?? '',
                    'urgency' => $inc['urgency'] ?? '',
                    'created_at' => $inc['created_at'] ?? null,
                    'updated_at' => $inc['updated_at'] ?? null,
                    'service' => [
                        'id' => $inc['service']['id'] ?? '',
                        'name' => $inc['service']['name'] ?? '',
                    ],
                    'assigned_to' => array_map(function (array $a) {
                        return [
                            'id' => $a['assignee']['id'] ?? '',
                            'name' => $a['assignee']['summary'] ?? '',
                            'type' => $a['assignee']['type'] ?? '',
                        ];
                    }, $inc['assignments'] ?? []),
                ];
            }, $result['incidents'] ?? []);

            return ToolResult::success([
                'incidents' => $incidents,
                'total' => $result['total'] ?? count($incidents),
                'more' => $result['more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
