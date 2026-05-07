<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Batch-create multiple rows in a Baserow table.
 */
class BaserowBatchCreate implements Tool
{
    /**
     * @param  BaserowService  $service  The Baserow API client.
     */
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_batch_create';
    }

    public function description(): string
    {
        return 'Create multiple rows in a Baserow table in a single request.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'records'  => ['type' => 'string', 'required' => true, 'description' => 'JSON array of row objects, e.g. [{"field_1": "a"}, {"field_1": "b"}]. Each object is flat key-value pairs.'],
        ];
    }

    /**
     * Execute the batch create tool.
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

            $result = $this->service->batchCreate((int) $tableId, $recordsData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
