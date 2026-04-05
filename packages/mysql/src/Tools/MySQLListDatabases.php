<?php

namespace OpenCompany\Integrations\MySQL\Tools;

use OpenCompany\Integrations\MySQL\MySQLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all accessible databases on the MySQL server.
 */
class MySQLListDatabases implements Tool
{
    public function __construct(
        private MySQLService $service,
    ) {}

    public function name(): string
    {
        return 'mysql_list_databases';
    }

    public function description(): string
    {
        return 'List all databases accessible to the authenticated MySQL user. Use this to discover which databases are available before querying or exploring tables.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MySQL integration is not configured.');
            }

            $result = $this->service->listDatabases();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
