<?php

namespace OpenCompany\Integrations\ServiceNow\Tools;

use OpenCompany\Integrations\ServiceNow\ServiceNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get a single ServiceNow incident.
 *
 * Retrieves one incident record by its sys_id.
 */
class ServiceNowGetIncident implements Tool
{
    public function __construct(
        private ServiceNowService $service,
    ) {}

    public function name(): string
    {
        return 'servicenow_get_incident';
    }

    public function description(): string
    {
        return 'Retrieve a single ServiceNow incident by its sys_id. Returns the full incident record.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The sys_id of the incident to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ServiceNow integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The "id" parameter (sys_id) is required.');
            }

            $result = $this->service->getIncident($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
