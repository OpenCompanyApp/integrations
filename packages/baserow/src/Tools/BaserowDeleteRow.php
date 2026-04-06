<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a row from a Baserow database table by its ID.
 */
class BaserowDeleteRow implements Tool
{
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_delete_row';
    }

    public function description(): string
    {
        return 'Delete a row from a Baserow database table. This action is permanent and cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'row_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the row to delete.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Baserow integration is not configured.');
            }

            $tableId = (int) $args['table_id'];
            $rowId = (int) $args['row_id'];

            $this->service->deleteRow($tableId, $rowId);

            return ToolResult::success("Row {$rowId} has been deleted from table {$tableId}.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
