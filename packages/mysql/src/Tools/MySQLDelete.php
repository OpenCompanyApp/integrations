<?php

namespace OpenCompany\Integrations\MySQL\Tools;

use OpenCompany\Integrations\MySQL\MySQLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete rows from a MySQL table matching a filter.
 */
class MySQLDelete implements Tool
{
    public function __construct(
        private MySQLService $service,
    ) {}

    public function name(): string
    {
        return 'mysql_delete';
    }

    public function description(): string
    {
        return 'Delete rows from a MySQL table that match a filter. Provide a filter with column-value pairs to identify which rows to delete. This action is irreversible — use with caution.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name (e.g., "my_app").'],
            'table' => ['type' => 'string', 'required' => true, 'description' => 'The table name (e.g., "users").'],
            'filter' => ['type' => 'object', 'required' => true, 'description' => 'Column-value pairs to match rows for deletion (e.g., {"id": 42}).'],
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

            $result = $this->service->delete($args['database'], $args['table'], $args['filter']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
