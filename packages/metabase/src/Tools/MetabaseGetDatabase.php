<?php

namespace OpenCompany\Integrations\Metabase\Tools;

use OpenCompany\Integrations\Metabase\MetabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MetabaseGetDatabase implements Tool
{
    public function __construct(
        private MetabaseService $service,
    ) {}

    public function name(): string
    {
        return 'metabase_get_database';
    }

    public function description(): string
    {
        return 'Get detailed metadata for a Metabase database by ID, including its tables, fields, and schema information. Use metabase_list_databases to find database IDs.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The database ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Metabase integration is not configured.');
            }

            $database = $this->service->getDatabase((int) $args['id']);

            return ToolResult::success($database);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
