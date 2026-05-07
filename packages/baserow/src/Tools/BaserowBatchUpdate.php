<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Batch-update multiple rows in a Baserow table.
 */
class BaserowBatchUpdate implements Tool
{
    /**
     * @param  BaserowService  $service  The Baserow API client.
     */
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_batch_update';
    }

    public function description(): string
    {
        return 'Update multiple rows in a Baserow table in a single request. Each row must include its "id".';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'records'  => ['type' => 'string', 'required' => true, 'description' => 'JSON array of row objects to update. Each must include an "id" key, e.g. [{"id": 1, "field_1": "new"}, {"id": 2, "field_1": "new"}].'],
        ];
    }

    /**
     * Execute the batch update tool.
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
            $records = $args['records'] ?? null;

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($records)) {
                return ToolResult::error('records is required.');
            }

            $recordsData = is_string($records) ? json_decode($records, true) : $records;
            if (! is_array($recordsData)) {
                return ToolResult::error('records must be a valid JSON array.');
            }

            $result = $this->service->batchUpdate((int) $tableId, $recordsData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
