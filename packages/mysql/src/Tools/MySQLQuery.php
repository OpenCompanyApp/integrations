<?php

namespace OpenCompany\Integrations\MySQL\Tools;

use OpenCompany\Integrations\MySQL\MySQLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a raw SQL query against the MySQL database via the HTTP REST bridge.
 */
class MySQLQuery implements Tool
{
    public function __construct(
        private MySQLService $service,
    ) {}

    public function name(): string
    {
        return 'mysql_query';
    }

    public function description(): string
    {
        return 'Execute a raw SQL query on the MySQL database. Supports SELECT, INSERT, UPDATE, DELETE, and other SQL statements. Use for custom queries, joins, aggregations, and complex data retrieval.';
    }

    public function parameters(): array
    {
        return [
            'sql' => ['type' => 'string', 'required' => true, 'description' => 'The SQL query to execute (e.g., "SELECT * FROM users WHERE active = 1 LIMIT 10").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MySQL integration is not configured.');
            }

            $result = $this->service->query($args['sql']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
