<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update multiple records in a single NocoDB API request.
 */
class NocoDBBatchUpdate implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_batch_update';
    }

    public function description(): string
    {
        return 'Update multiple records in a single NocoDB API request.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'Table ID.'],
            'records'  => ['type' => 'string', 'required' => true, 'description' => 'JSON array of record objects, each with an "Id" key and fields to update (e.g., [{"Id":1,"Name":"Updated"}]).'],
        ];
    }

    /**
     * Update multiple records in a batch.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table_id, records)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NocoDB integration is not configured.');
            }

            $tableId = $args['table_id'] ?? '';
            $records = $args['records'] ?? '';

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($records)) {
                return ToolResult::error('records is required.');
            }

            $recordsArray = is_string($records) ? json_decode($records, true) : $records;

            if (! is_array($recordsArray)) {
                return ToolResult::error('records must be a valid JSON array.');
            }

            $result = $this->service->batchUpdate($tableId, $recordsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
