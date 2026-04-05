<?php

namespace OpenCompany\Integrations\ServiceNow\Tools;

use OpenCompany\Integrations\ServiceNow\ServiceNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get a single ServiceNow task.
 *
 * Retrieves one task record by its sys_id.
 */
class ServiceNowGetTask implements Tool
{
    public function __construct(
        private ServiceNowService $service,
    ) {}

    public function name(): string
    {
        return 'servicenow_get_task';
    }

    public function description(): string
    {
        return 'Retrieve a single ServiceNow task by its sys_id. Returns the full task record.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The sys_id of the task to retrieve.'],
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

            $result = $this->service->getTask($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
