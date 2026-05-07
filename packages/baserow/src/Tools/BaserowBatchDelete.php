<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Batch-delete multiple rows from a Baserow table.
 */
class BaserowBatchDelete implements Tool
{
    /**
     * @param  BaserowService  $service  The Baserow API client.
     */
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_batch_delete';
    }

    public function description(): string
    {
        return 'Delete multiple rows from a Baserow table in a single request.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'row_ids'  => ['type' => 'string', 'required' => true, 'description' => 'JSON array of row IDs to delete, e.g. [1, 2, 3].'],
        ];
    }

    /**
     * Execute the batch delete tool.
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
            $rowIds  = $args['row_ids'] ?? null;

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($rowIds)) {
                return ToolResult::error('row_ids is required.');
            }

            $ids = is_string($rowIds) ? json_decode($rowIds, true) : $rowIds;
            if (! is_array($ids)) {
                return ToolResult::error('row_ids must be a valid JSON array of integers.');
            }

            $this->service->batchDelete((int) $tableId, $ids);

            return ToolResult::success([
                'deleted'  => true,
                'table_id' => (int) $tableId,
                'row_ids'  => $ids,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
