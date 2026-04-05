<?php

namespace OpenCompany\Integrations\PagerDuty\Tools;

use OpenCompany\Integrations\PagerDuty\PagerDutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a PagerDuty incident's status and/or priority.
 *
 * Supports status transitions (acknowledged, resolved, triggered) and
 * priority assignment. The incident ID is provided as a parameter and
 * also set in the URL path per PagerDuty API requirements.
 */
class PagerDutyUpdateIncident implements Tool
{
    /**
     * @param  PagerDutyService  $service  The PagerDuty API client
     */
    public function __construct(
        private PagerDutyService $service,
    ) {}

    public function name(): string
    {
        return 'pagerduty_update_incident';
    }

    public function description(): string
    {
        return <<<'MD'
        Update a PagerDuty incident's status and/or priority.
        Supports status transitions: "acknowledged", "resolved", "triggered".
        Priority can be set to a priority ID from the account's priority levels.
        MD;
    }

    public function parameters(): array
    {
        return [
            'incident_id' => ['type' => 'string', 'required' => true, 'description' => 'PagerDuty incident ID to update.'],
            'status' => ['type' => 'string', 'description' => 'New status. Values: "triggered", "acknowledged", "resolved".'],
            'priority' => ['type' => 'string', 'description' => 'Priority ID to assign (e.g., "P53ZZH5" for high, "POM2KE7" for low). Use the priority IDs from your PagerDuty account.'],
        ];
    }

    /**
     * Update a PagerDuty incident's status and/or priority.
     *
     * @param  array<string, mixed>  $args  Tool arguments (incident_id, status, priority)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $incidentId = $args['incident_id'] ?? '';
            if (empty($incidentId)) {
                return ToolResult::error('incident_id is required.');
            }

            $data = [];
            $data['id'] = $incidentId;
            $data['type'] = 'incident_reference';

            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }

            if (isset($args['priority'])) {
                $data['priority'] = [
                    'id' => $args['priority'],
                    'type' => 'priority_reference',
                ];
            }

            $result = $this->service->updateIncident($incidentId, $data);
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
                'updated_at' => $inc['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
