<?php

namespace OpenCompany\Integrations\Snowflake\Tools;

use OpenCompany\Integrations\Snowflake\SnowflakeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SnowflakeDescribeTable implements Tool
{
    public function __construct(
        private SnowflakeService $service,
    ) {}

    public function name(): string
    {
        return 'snowflake_describe_table';
    }

    public function description(): string
    {
        return 'Describe a Snowflake table — get column names, data types, nullable, default values, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'database' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
            'schema' => ['type' => 'string', 'required' => true, 'description' => 'The schema name.'],
            'table' => ['type' => 'string', 'required' => true, 'description' => 'The table name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Snowflake integration is not configured.');
            }

            $result = $this->service->describeTable(
                $args['database'],
                $args['schema'],
                $args['table'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
