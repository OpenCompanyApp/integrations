<?php

namespace OpenCompany\Integrations\MySQL\Tools;

use OpenCompany\Integrations\MySQL\MySQLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Insert a new row into a MySQL table.
 */
class MySQLInsert implements Tool
{
    public function __construct(
        private MySQLService $service,
    ) {}

    public function name(): string
    {
        return 'mysql_insert';
    }

    public function description(): string
    {
        return 'Insert a new row into a MySQL table. Provide column names and values as key-value pairs. Use mysql_describe_table first to understand the schema if needed.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name (e.g., "my_app").'],
            'table' => ['type' => 'string', 'required' => true, 'description' => 'The table name (e.g., "users").'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Column-value pairs to insert (e.g., {"name": "Alice", "email": "alice@example.com"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MySQL integration is not configured.');
            }

            if (empty($args['data']) || !is_array($args['data'])) {
                return ToolResult::error('The data parameter must be a non-empty object with column-value pairs.');
            }

            $result = $this->service->insert($args['database'], $args['table'], $args['data']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
