<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

use OpenCompany\Integrations\Pagerduty\PagerdutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Service.
 *
 * Retrieves a single PagerDuty service by its ID, including its escalation
 * policy, integrations, and alert creation settings.
 *
 * @see https://developer.pagerduty.com/api-reference/get-a-service
 */
class PagerdutyGetService implements Tool
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
        return 'pagerduty_get_service';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get full details for a single PagerDuty service, including status, escalation policy, integrations, and alert settings.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The service ID (e.g., "PIJ90N7").'],
        ];
    }

    /**
     * Execute the get service tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the service ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Service ID is required.');
            }

            $result = $this->service->getService($id);

            return ToolResult::success($result['service'] ?? $result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
