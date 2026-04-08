<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

use OpenCompany\Integrations\QuickBase\QuickBaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QuickBaseListTables implements Tool
{
    public function __construct(
        private QuickBaseService $service,
    ) {}

    public function name(): string
    {
        return 'quickbase_list_tables';
    }

    public function description(): string
    {
        return 'List all tables in a QuickBase application. Returns table IDs, names, and metadata for each table in the specified app.';
    }

    public function parameters(): array
    {
        return [
            'appId' => ['type' => 'string', 'required' => true, 'description' => 'The application ID (dbid) to list tables for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('QuickBase integration is not configured.');
            }

            $appId = $args['appId'] ?? '';
            if (empty($appId)) {
                return ToolResult::error('The appId parameter is required.');
            }

            $result = $this->service->listTables($appId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
