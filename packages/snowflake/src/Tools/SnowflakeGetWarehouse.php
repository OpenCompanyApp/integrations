<?php

namespace OpenCompany\Integrations\Snowflake\Tools;

use OpenCompany\Integrations\Snowflake\SnowflakeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SnowflakeGetWarehouse implements Tool
{
    public function __construct(
        private SnowflakeService $service,
    ) {}

    public function name(): string
    {
        return 'snowflake_get_warehouse';
    }

    public function description(): string
    {
        return 'Get details for a specific Snowflake warehouse, including size, type, auto-suspend, and auto-resume settings.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The warehouse name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Snowflake integration is not configured.');
            }

            $result = $this->service->getWarehouse($args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
