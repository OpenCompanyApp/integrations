<?php

namespace OpenCompany\Integrations\ServiceNow\Tools;

use OpenCompany\Integrations\ServiceNow\ServiceNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List ServiceNow tasks.
 *
 * Queries the task table using an optional encoded query string
 * and returns up to the specified number of records.
 */
class ServiceNowListTasks implements Tool
{
    public function __construct(
        private ServiceNowService $service,
    ) {}

    public function name(): string
    {
        return 'servicenow_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks from the ServiceNow task table. Supports filtering via an encoded query string and a configurable result limit.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'ServiceNow encoded query string to filter results (e.g. "active=true^assigned_to=javascript:gs.getUserID()").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of tasks to return (default: 20).'],
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

            $result = $this->service->listTasks($query, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
