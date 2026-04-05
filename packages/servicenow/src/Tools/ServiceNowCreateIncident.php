<?php

namespace OpenCompany\Integrations\ServiceNow\Tools;

use OpenCompany\Integrations\ServiceNow\ServiceNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create a ServiceNow incident.
 *
 * Creates a new incident with the given short_description, description,
 * and optional priority. Additional fields can be passed as well.
 */
class ServiceNowCreateIncident implements Tool
{
    public function __construct(
        private ServiceNowService $service,
    ) {}

    public function name(): string
    {
        return 'servicenow_create_incident';
    }

    public function description(): string
    {
        return 'Create a new ServiceNow incident. Provide a short description, an optional full description, and a priority level.';
    }

    public function parameters(): array
    {
        return [
            'short_description' => ['type' => 'string', 'required' => true, 'description' => 'A brief summary of the incident.'],
            'description'       => ['type' => 'string', 'description' => 'A detailed description of the incident.'],
            'priority'          => ['type' => 'string', 'description' => 'Priority level: "1" (critical), "2" (high), "3" (moderate), "4" (low), "5" (planning). Defaults to the system default if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ServiceNow integration is not configured.');
            }

            if (empty($args['short_description'])) {
                return ToolResult::error('The "short_description" parameter is required.');
            }

            $data = ['short_description' => $args['short_description']];

            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }

            if (isset($args['priority'])) {
                $data['priority'] = $args['priority'];
            }

            $result = $this->service->createIncident($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
