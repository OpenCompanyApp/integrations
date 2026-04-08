<?php

namespace OpenCompany\Integrations\ServiceNow\Tools;

use OpenCompany\Integrations\ServiceNow\ServiceNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Update a ServiceNow incident.
 *
 * Patches an existing incident identified by its sys_id with the
 * provided field values.
 */
class ServiceNowUpdateIncident implements Tool
{
    public function __construct(
        private ServiceNowService $service,
    ) {}

    public function name(): string
    {
        return 'servicenow_update_incident';
    }

    public function description(): string
    {
        return 'Update an existing ServiceNow incident. Provide the incident sys_id and the fields to update.';
    }

    public function parameters(): array
    {
        return [
            'id'        => ['type' => 'string', 'required' => true, 'description' => 'The sys_id of the incident to update.'],
            'fields'    => ['type' => 'object', 'required' => true, 'description' => 'An object of field names and their new values. Common fields: state, priority, short_description, description, work_notes, comments, assigned_to.'],
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

            if (empty($args['fields']) || ! is_array($args['fields'])) {
                return ToolResult::error('The "fields" parameter must be a non-empty object.');
            }

            $result = $this->service->updateIncident($args['id'], $args['fields']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
