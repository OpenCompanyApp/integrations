<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

use OpenCompany\Integrations\Pagerduty\PagerdutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Incident.
 *
 * Retrieves a single PagerDuty incident by its ID, including all associated
 * alerts, assignments, and context.
 *
 * @see https://developer.pagerduty.com/api-reference/get-an-incident
 */
class PagerdutyGetIncident implements Tool
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
        return 'pagerduty_get_incident';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get full details for a single PagerDuty incident, including status, urgency, assignments, alerts, and timeline.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The incident ID (e.g., "Q02JTSZO2VGFBH").'],
        ];
    }

    /**
     * Execute the get incident tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the incident ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Incident ID is required.');
            }

            $result = $this->service->getIncident($id);

            return ToolResult::success($result['incident'] ?? $result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
