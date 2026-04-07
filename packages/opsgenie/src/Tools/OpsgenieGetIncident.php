<?php

namespace OpenCompany\Integrations\Opsgenie\Tools;

use OpenCompany\Integrations\Opsgenie\OpsgenieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Opsgenie incident.
 *
 * Returns the full incident object including message, description, priority,
 * status, impacted services, and responder information.
 */
class OpsgenieGetIncident implements Tool
{
    /**
     * Create a new OpsgenieGetIncident tool instance.
     *
     * @param  OpsgenieService  $service  The Opsgenie API service
     */
    public function __construct(
        private OpsgenieService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'opsgenie_get_incident';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get full details of a specific Opsgenie incident by its ID. Returns message, description, priority, status, impacted services, and responders.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'incident_id' => ['type' => 'string', 'required' => true, 'description' => 'The Opsgenie incident ID.'],
        ];
    }

    /**
     * Execute the tool and return the incident details.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Opsgenie integration is not configured.');
            }

            $incidentId = $args['incident_id'] ?? '';

            if (empty($incidentId)) {
                return ToolResult::error('Incident ID is required.');
            }

            $result = $this->service->getIncident($incidentId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
