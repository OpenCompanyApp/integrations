<?php

namespace OpenCompany\Integrations\MySQL\Tools;

use OpenCompany\Integrations\MySQL\MySQLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update rows in a MySQL table matching a filter.
 */
class MySQLUpdate implements Tool
{
    public function __construct(
        private MySQLService $service,
    ) {}

    public function name(): string
    {
        return 'mysql_update';
    }

    public function description(): string
    {
        return 'Update rows in a MySQL table that match a filter. Provide a filter to identify which rows to update and a data object with the new column values. Use mysql_describe_table first to understand the schema if needed.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name (e.g., "my_app").'],
            'table' => ['type' => 'string', 'required' => true, 'description' => 'The table name (e.g., "users").'],
            'filter' => ['type' => 'object', 'required' => true, 'description' => 'Column-value pairs to match rows for update (e.g., {"id": 42}).'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Column-value pairs to update (e.g., {"name": "Bob", "status": "active"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MySQL integration is not configured.');
            }

            if (empty($args['filter']) || !is_array($args['filter'])) {
                return ToolResult::error('The filter parameter must be a non-empty object with column-value pairs to match rows.');
            }

            if (empty($args['data']) || !is_array($args['data'])) {
                return ToolResult::error('The data parameter must be a non-empty object with column-value pairs to update.');
            }

            $result = $this->service->update($args['database'], $args['table'], $args['filter'], $args['data']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
