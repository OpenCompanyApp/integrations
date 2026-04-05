<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Baserow row by its ID.
 */
class BaserowGetRow implements Tool
{
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_get_row';
    }

    public function description(): string
    {
        return 'Get a single Baserow row by its table and row ID.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'row_id'   => ['type' => 'integer', 'required' => true, 'description' => 'The row ID to retrieve.'],
        ];
    }

    /**
     * Execute the get row tool.
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
            $rowId   = $args['row_id'] ?? null;

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($rowId)) {
                return ToolResult::error('row_id is required.');
            }

            $result = $this->service->getRow((int) $tableId, (int) $rowId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
