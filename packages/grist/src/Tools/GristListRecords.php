<?php

namespace OpenCompany\Integrations\Grist\Tools;

use OpenCompany\Integrations\Grist\GristService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List records from a Grist table with optional filtering and sorting.
 */
class GristListRecords implements Tool
{
    /**
     * @param  GristService  $service  The Grist API client
     */
    public function __construct(
        private GristService $service,
    ) {}

    public function name(): string
    {
        return 'grist_list_records';
    }

    public function description(): string
    {
        return 'List records from a Grist table with optional filtering, sorting, and limiting.';
    }

    public function parameters(): array
    {
        return [
            'doc_id'   => ['type' => 'string', 'required' => true, 'description' => 'Grist document ID.'],
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'Grist table ID.'],
            'limit'    => ['type' => 'integer', 'description' => 'Maximum number of records to return.'],
            'sort'     => ['type' => 'string', 'description' => 'Sort expression, e.g. "Col1" (ascending) or "-Col1" (descending).'],
            'filter'   => ['type' => 'string', 'description' => 'JSON object for column filtering, e.g. {"Col1": ["val1", "val2"]}.'],
        ];
    }

    /**
     * List records from a table with optional filtering and sorting.
     *
     * @param  array<string, mixed>  $args  Tool arguments (doc_id, table_id, limit, sort, filter)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Grist integration is not configured.');
            }

            $docId = $args['doc_id'] ?? '';
            $tableId = $args['table_id'] ?? '';

            if (empty($docId)) {
                return ToolResult::error('doc_id is required.');
            }
            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $sort = ! empty($args['sort']) ? $args['sort'] : null;
            $filter = null;

            if (! empty($args['filter'])) {
                $filter = is_string($args['filter']) ? json_decode($args['filter'], true) : $args['filter'];
                if (! is_array($filter)) {
                    return ToolResult::error('filter must be a valid JSON object.');
                }
            }

            $result = $this->service->listRecords($docId, $tableId, $limit, $sort, $filter);

            return ToolResult::success([
                'records' => $result['records'] ?? $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
