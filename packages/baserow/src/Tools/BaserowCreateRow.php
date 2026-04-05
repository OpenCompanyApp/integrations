<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new row in a Baserow table.
 */
class BaserowCreateRow implements Tool
{
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_create_row';
    }

    public function description(): string
    {
        return 'Create a new row in a Baserow table with the provided field values.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'data'     => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field values, e.g. {"field_1": "value", "field_2": 42}. Keys are field names or field_<id>.'],
            'before'   => ['type' => 'integer', 'description' => 'If provided, the new row will be positioned before this row ID.'],
        ];
    }

    /**
     * Execute the create row tool.
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
            $data    = $args['data'] ?? null;

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($data)) {
                return ToolResult::error('data is required.');
            }

            $fieldData = is_string($data) ? json_decode($data, true) : $data;
            if (! is_array($fieldData)) {
                return ToolResult::error('data must be a valid JSON object.');
            }

            $before = isset($args['before']) ? (int) $args['before'] : null;

            $result = $this->service->createRow((int) $tableId, $fieldData, $before);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
