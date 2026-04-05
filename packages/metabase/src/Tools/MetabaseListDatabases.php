<?php

namespace OpenCompany\Integrations\Metabase\Tools;

use OpenCompany\Integrations\Metabase\MetabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MetabaseListDatabases implements Tool
{
    public function __construct(
        private MetabaseService $service,
    ) {}

    public function name(): string
    {
        return 'metabase_list_databases';
    }

    public function description(): string
    {
        return 'List all databases connected to Metabase. Returns database IDs, names, engine types, and metadata. Use metabase_get_database to retrieve tables and fields for a specific database.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Metabase integration is not configured.');
            }

            $result = $this->service->listDatabases();
            $databases = $result['data'] ?? $result;

            return ToolResult::success([
                'databases' => $databases,
                'count' => count($databases),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
