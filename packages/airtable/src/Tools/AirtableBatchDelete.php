<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete up to 10 records in a single Airtable API request.
 */
class AirtableBatchDelete implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_batch_delete';
    }

    public function description(): string
    {
        return 'Delete up to 10 records in a single Airtable API request.';
    }

    public function parameters(): array
    {
        return [
            'base_id'    => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
            'table'      => ['type' => 'string', 'required' => true, 'description' => 'Table ID or name.'],
            'record_ids' => ['type' => 'string', 'required' => true, 'description' => 'JSON array of record IDs to delete (e.g., ["recA","recB"]). Max 10 IDs.'],
        ];
    }

    /**
     * Delete multiple records in a batch.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table, record_ids)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Airtable integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';
            $table = $args['table'] ?? '';
            $recordIds = $args['record_ids'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($recordIds)) {
                return ToolResult::error('record_ids is required.');
            }

            $idsArray = is_string($recordIds) ? json_decode($recordIds, true) : $recordIds;

            if (! is_array($idsArray)) {
                return ToolResult::error('record_ids must be a valid JSON array.');
            }

            if (count($idsArray) > 10) {
                return ToolResult::error('A maximum of 10 records can be deleted in a single batch request.');
            }

            $result = $this->service->batchDelete($baseId, $table, $idsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
