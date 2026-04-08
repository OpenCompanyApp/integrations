<?php

namespace OpenCompany\Integrations\Convex\Tools;

use OpenCompany\Integrations\Convex\ConvexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all tables in the Convex deployment.
 */
class ConvexListTables implements Tool
{
    /**
     * @param  ConvexService  $service  The Convex API client
     */
    public function __construct(
        private ConvexService $service,
    ) {}

    public function name(): string
    {
        return 'convex_list_tables';
    }

    public function description(): string
    {
        return 'List all tables in the Convex deployment.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all tables.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Convex integration is not configured.');
            }

            $result = $this->service->listTables();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
