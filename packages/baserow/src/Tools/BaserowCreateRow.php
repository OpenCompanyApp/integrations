<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new row in a Baserow database table.
 *
 * Accepts field data as a JSON object mapping field names (or field IDs)
 * to their values. The data is sent as the request body.
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
        return 'Create a new row in a Baserow database table. Provide field data as a JSON object mapping field names to values.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID to create the row in.'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Row data as a JSON object with field names (or field IDs) as keys and their values. Example: {"Name": "John", "Email": "john@example.com"}.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Baserow integration is not configured.');
            }

            $tableId = (int) $args['table_id'];
            $data = $args['data'] ?? [];

            if (is_string($data)) {
                $data = json_decode($data, true) ?? [];
            }

            if (empty($data)) {
                return ToolResult::error('Row data cannot be empty. Provide at least one field value.');
            }

            $result = $this->service->createRow($tableId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
