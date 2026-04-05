<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update up to 10 records in a single Airtable API request.
 */
class AirtableBatchUpdate implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_batch_update';
    }

    public function description(): string
    {
        return 'Update up to 10 records in a single Airtable API request.';
    }

    public function parameters(): array
    {
        return [
            'base_id' => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
            'table'   => ['type' => 'string', 'required' => true, 'description' => 'Table ID or name.'],
            'records' => ['type' => 'string', 'required' => true, 'description' => 'JSON array of record objects, each with "id" and "fields" keys (e.g., [{"id":"recX","fields":{"Name":"Alice"}}]). Max 10 records.'],
        ];
    }

    /**
     * Update multiple records in a batch.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table, records)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Airtable integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';
            $table = $args['table'] ?? '';
            $records = $args['records'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($records)) {
                return ToolResult::error('records is required.');
            }

            $recordsArray = is_string($records) ? json_decode($records, true) : $records;

            if (! is_array($recordsArray)) {
                return ToolResult::error('records must be a valid JSON array.');
            }

            if (count($recordsArray) > 10) {
                return ToolResult::error('A maximum of 10 records can be updated in a single batch request.');
            }

            $result = $this->service->batchUpdate($baseId, $table, $recordsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
