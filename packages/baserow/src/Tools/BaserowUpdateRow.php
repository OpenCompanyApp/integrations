<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing row in a Baserow database table.
 *
 * Accepts field data as a JSON object mapping field names (or field IDs)
 * to their new values. Only the specified fields are updated.
 */
class BaserowUpdateRow implements Tool
{
    /**
     * @param  BaserowService  $service  The Baserow API client.
     */
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_update_row';
    }

    public function description(): string
    {
        return 'Update an existing row in a Baserow database table. Provide field data as a JSON object with field names and new values. Only specified fields are updated.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'row_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the row to update.'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Updated field data as a JSON object with field names (or field IDs) as keys and their new values. Example: {"Name": "Jane", "Status": "Active"}.'],
        ];
    }

    /**
     * Update a row in a Baserow table.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Baserow integration is not configured.');
            }

            $tableId = (int) $args['table_id'];
            $rowId = (int) $args['row_id'];
            $data = $args['data'] ?? [];

            if (is_string($data)) {
                $data = json_decode($data, true) ?? [];
            }

            if (empty($data)) {
                return ToolResult::error('Update data cannot be empty. Provide at least one field to update.');
            }

            $result = $this->service->updateRow($tableId, $rowId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
