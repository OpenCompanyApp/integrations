<?php

namespace OpenCompany\Integrations\Upstash\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Upstash\UpstashService;

/**
 * Tool to list all Redis databases in the Upstash account.
 *
 * Calls GET /v2/redis/databases on the Upstash Platform API
 * (https://api.upstash.com).
 */
class UpstashListDatabases implements Tool
{
    /**
     * Create a new UpstashListDatabases tool instance.
     */
    public function __construct(
        private UpstashService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'upstash_list_databases';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all Redis databases in the Upstash account. Returns database IDs, names, regions, and endpoints.';
    }

    /**
     * Parameter schema for this tool.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool: list all databases.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Upstash integration is not configured.');
            }

            $databases = $this->service->listDatabases();

            return ToolResult::success($databases);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
