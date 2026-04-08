<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List rows in a Baserow database table with pagination and filtering.
 *
 * Supports pagination via page/size parameters and optional Baserow-compatible
 * filter parameters for narrowing results.
 */
class BaserowListTables implements Tool
{
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_list_tables';
    }

    public function description(): string
    {
        return 'List rows in a Baserow database table. Supports pagination and optional filters to narrow results by field values.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID to list rows from.'],
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based). Defaults to 1.'],
            'size' => ['type' => 'integer', 'description' => 'Number of rows per page. Defaults to 100.'],
            'filters' => ['type' => 'object', 'description' => 'Optional Baserow filter parameters as key-value pairs (e.g., {"search": "term"}, {"filter__field_1__equal": "value"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Baserow integration is not configured.');
            }

            $tableId = (int) $args['table_id'];
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $size = isset($args['size']) ? (int) $args['size'] : 100;
            $filters = $args['filters'] ?? [];

            if (is_string($filters)) {
                $filters = json_decode($filters, true) ?? [];
            }

            $result = $this->service->listTableRows($tableId, $page, $size, $filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
