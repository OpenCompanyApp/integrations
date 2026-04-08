<?php

namespace OpenCompany\Integrations\Snowflake\Tools;

use OpenCompany\Integrations\Snowflake\SnowflakeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SnowflakeListTables implements Tool
{
    public function __construct(
        private SnowflakeService $service,
    ) {}

    public function name(): string
    {
        return 'snowflake_list_tables';
    }

    public function description(): string
    {
        return 'List all tables within a Snowflake database schema. Returns table names, types, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'schema' => ['type' => 'string', 'required' => true, 'description' => 'The schema name within the database.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Snowflake integration is not configured.');
            }

            $result = $this->service->listTables($args['database'], $args['schema']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
