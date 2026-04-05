<?php

namespace OpenCompany\Integrations\PagerDuty\Tools;

use OpenCompany\Integrations\PagerDuty\PagerDutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single PagerDuty incident by ID.
 *
 * Returns full incident details including status, urgency, service,
 * assignments, acknowledgements, and priority.
 */
class PagerDutyGetIncident implements Tool
{
    /**
     * @param  PagerDutyService  $service  The PagerDuty API client
     */
    public function __construct(
        private PagerDutyService $service,
    ) {}

    public function name(): string
    {
        return 'pagerduty_get_incident';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a PagerDuty incident by ID.
        Returns full incident details including status, urgency, service,
        assignments, acknowledgements, and priority.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'PagerDuty incident ID (e.g., "Q02JFSRXI65D55").'],
        ];
    }

    /**
     * Retrieve a PagerDuty incident by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getIncident($id);
            $inc = $result['incident'] ?? $result;

            return ToolResult::success([
                'id' => $inc['id'] ?? '',
                'title' => $inc['title'] ?? '',
                'status' => $inc['status'] ?? '',
                'urgency' => $inc['urgency'] ?? '',
                'priority' => [
                    'id' => $inc['priority']['id'] ?? null,
                    'name' => $inc['priority']['summary'] ?? null,
                ],
                'created_at' => $inc['created_at'] ?? null,
                'updated_at' => $inc['updated_at'] ?? null,
                'resolved_at' => $inc['last_status_change_at'] ?? null,
                'service' => [
                    'id' => $inc['service']['id'] ?? '',
                    'name' => $inc['service']['name'] ?? '',
                ],
                'assigned_to' => array_map(function (array $a) {
                    return [
                        'id' => $a['assignee']['id'] ?? '',
                        'name' => $a['assignee']['summary'] ?? '',
                    ];
                }, $inc['assignments'] ?? []),
                'acknowledged_by' => array_map(function (array $a) {
                    return [
                        'id' => $a['acknowledger']['id'] ?? '',
                        'name' => $a['acknowledger']['summary'] ?? '',
                    ];
                }, $inc['acknowledgements'] ?? []),
                'html_url' => $inc['html_url'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
