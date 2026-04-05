<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing row in a Baserow table.
 */
class BaserowUpdateRow implements Tool
{
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_update_row';
    }

    public function description(): string
    {
        return 'Update an existing row in a Baserow table with the provided field values.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'row_id'   => ['type' => 'integer', 'required' => true, 'description' => 'The row ID to update.'],
            'data'     => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field values to update, e.g. {"field_1": "new value", "field_2": 99}.'],
        ];
    }

    /**
     * Execute the update row tool.
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
            $data    = $args['data'] ?? null;

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($rowId)) {
                return ToolResult::error('row_id is required.');
            }
            if (empty($data)) {
                return ToolResult::error('data is required.');
            }

            $fieldData = is_string($data) ? json_decode($data, true) : $data;
            if (! is_array($fieldData)) {
                return ToolResult::error('data must be a valid JSON object.');
            }

            $result = $this->service->updateRow((int) $tableId, (int) $rowId, $fieldData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
