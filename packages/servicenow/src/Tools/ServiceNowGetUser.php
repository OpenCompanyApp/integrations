<?php

namespace OpenCompany\Integrations\ServiceNow\Tools;

use OpenCompany\Integrations\ServiceNow\ServiceNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get a single ServiceNow user.
 *
 * Retrieves one user record by their sys_id.
 */
class ServiceNowGetUser implements Tool
{
    public function __construct(
        private ServiceNowService $service,
    ) {}

    public function name(): string
    {
        return 'servicenow_get_user';
    }

    public function description(): string
    {
        return 'Retrieve a single ServiceNow user by their sys_id. Returns the full user record.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The sys_id of the user to retrieve.'],
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

            $result = $this->service->getUser($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
