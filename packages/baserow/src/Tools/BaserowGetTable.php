<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a single Baserow table.
 */
class BaserowGetTable implements Tool
{
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_get_table';
    }

    public function description(): string
    {
        return 'Get details for a single Baserow table by its ID.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
        ];
    }

    /**
     * Execute the get table tool.
     *
     * @param  array<string, mixed> $args Tool arguments
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Baserow integration is not configured.');
            }

            $tableId = $args['table_id'] ?? null;
            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }

            $result = $this->service->getTable((int) $tableId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
