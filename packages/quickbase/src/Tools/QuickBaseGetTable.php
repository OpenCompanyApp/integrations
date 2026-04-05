<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

use OpenCompany\Integrations\QuickBase\QuickBaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QuickBaseGetTable implements Tool
{
    public function __construct(
        private QuickBaseService $service,
    ) {}

    public function name(): string
    {
        return 'quickbase_get_table';
    }

    public function description(): string
    {
        return 'Get details for a specific QuickBase table, including its name, ID, and field definitions.';
    }

    public function parameters(): array
    {
        return [
            'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID (dbid) to retrieve details for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('QuickBase integration is not configured.');
            }

            $tableId = $args['tableId'] ?? '';
            if (empty($tableId)) {
                return ToolResult::error('The tableId parameter is required.');
            }

            $result = $this->service->getTable($tableId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
