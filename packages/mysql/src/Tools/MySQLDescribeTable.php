<?php

namespace OpenCompany\Integrations\MySQL\Tools;

use OpenCompany\Integrations\MySQL\MySQLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Describe the column structure of a MySQL table.
 */
class MySQLDescribeTable implements Tool
{
    public function __construct(
        private MySQLService $service,
    ) {}

    public function name(): string
    {
        return 'mysql_describe_table';
    }

    public function description(): string
    {
        return 'Get the column structure of a MySQL table. Returns column names, types, nullable status, keys, defaults, and extra info. Use this before inserting or updating data to understand the schema.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name (e.g., "my_app").'],
            'table' => ['type' => 'string', 'required' => true, 'description' => 'The table name (e.g., "users").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MySQL integration is not configured.');
            }

            $result = $this->service->describeTable($args['database'], $args['table']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
