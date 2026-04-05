<?php

namespace OpenCompany\Integrations\ServiceNow\Tools;

use OpenCompany\Integrations\ServiceNow\ServiceNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List ServiceNow users.
 *
 * Queries the sys_user table using an optional encoded query string
 * and returns up to the specified number of records.
 */
class ServiceNowListUsers implements Tool
{
    public function __construct(
        private ServiceNowService $service,
    ) {}

    public function name(): string
    {
        return 'servicenow_list_users';
    }

    public function description(): string
    {
        return 'List users from the ServiceNow sys_user table. Supports filtering via an encoded query string and a configurable result limit.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'ServiceNow encoded query string to filter results (e.g. "active=true^department=IT").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (default: 20).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ServiceNow integration is not configured.');
            }

            $query = $args['query'] ?? null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listUsers($query, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
