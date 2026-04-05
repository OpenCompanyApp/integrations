<?php

namespace OpenCompany\Integrations\ServiceNow\Tools;

use OpenCompany\Integrations\ServiceNow\ServiceNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create a ServiceNow task.
 *
 * Creates a new task with the provided field values.
 */
class ServiceNowCreateTask implements Tool
{
    public function __construct(
        private ServiceNowService $service,
    ) {}

    public function name(): string
    {
        return 'servicenow_create_task';
    }

    public function description(): string
    {
        return 'Create a new ServiceNow task. Provide a short description and optional additional fields.';
    }

    public function parameters(): array
    {
        return [
            'short_description' => ['type' => 'string', 'required' => true, 'description' => 'A brief summary of the task.'],
            'description'       => ['type' => 'string', 'description' => 'A detailed description of the task.'],
            'assigned_to'       => ['type' => 'string', 'description' => 'The sys_id of the user to assign the task to.'],
            'priority'          => ['type' => 'string', 'description' => 'Priority level: "1" (critical) through "5" (planning).'],
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
            if (isset($args['assigned_to'])) {
                $data['assigned_to'] = $args['assigned_to'];
            }
            if (isset($args['priority'])) {
                $data['priority'] = $args['priority'];
            }

            $result = $this->service->createTask($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
