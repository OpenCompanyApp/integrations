<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete multiple records in a single NocoDB API request.
 */
class NocoDBBatchDelete implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_batch_delete';
    }

    public function description(): string
    {
        return 'Delete multiple records in a single NocoDB API request.';
    }

    public function parameters(): array
    {
        return [
            'table_id'    => ['type' => 'string', 'required' => true, 'description' => 'Table ID.'],
            'record_ids'  => ['type' => 'string', 'required' => true, 'description' => 'JSON array of record IDs to delete (e.g., [1, 2, 3]).'],
        ];
    }

    /**
     * Delete multiple records in a batch.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table_id, record_ids)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NocoDB integration is not configured.');
            }

            $tableId = $args['table_id'] ?? '';
            $recordIds = $args['record_ids'] ?? '';

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($recordIds)) {
                return ToolResult::error('record_ids is required.');
            }

            $idsArray = is_string($recordIds) ? json_decode($recordIds, true) : $recordIds;

            if (! is_array($idsArray)) {
                return ToolResult::error('record_ids must be a valid JSON array.');
            }

            $this->service->batchDelete($tableId, $idsArray);

            return ToolResult::success([
                'deleted' => true,
                'record_ids' => $idsArray,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
