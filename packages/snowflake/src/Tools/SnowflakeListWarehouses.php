<?php

namespace OpenCompany\Integrations\Snowflake\Tools;

use OpenCompany\Integrations\Snowflake\SnowflakeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SnowflakeListWarehouses implements Tool
{
    public function __construct(
        private SnowflakeService $service,
    ) {}

    public function name(): string
    {
        return 'snowflake_list_warehouses';
    }

    public function description(): string
    {
        return 'List all warehouses in the Snowflake account. Returns warehouse names, sizes, and status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Snowflake integration is not configured.');
            }

            $result = $this->service->listWarehouses();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
