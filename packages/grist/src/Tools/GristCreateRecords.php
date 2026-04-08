<?php

namespace OpenCompany\Integrations\Grist\Tools;

use OpenCompany\Integrations\Grist\GristService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create one or more records in a Grist table.
 */
class GristCreateRecords implements Tool
{
    /**
     * @param  GristService  $service  The Grist API client
     */
    public function __construct(
        private GristService $service,
    ) {}

    public function name(): string
    {
        return 'grist_create_records';
    }

    public function description(): string
    {
        return 'Create one or more records in a Grist table.';
    }

    public function parameters(): array
    {
        return [
            'doc_id'   => ['type' => 'string', 'required' => true, 'description' => 'Grist document ID.'],
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'Grist table ID.'],
            'records'  => ['type' => 'string', 'required' => true, 'description' => 'JSON array of record objects, each with a "fields" key (e.g., [{"fields":{"Col1":"val","Col2":42}}]).'],
        ];
    }

    /**
     * Create records in a Grist table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (doc_id, table_id, records)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Grist integration is not configured.');
            }

            $docId = $args['doc_id'] ?? '';
            $tableId = $args['table_id'] ?? '';
            $records = $args['records'] ?? '';

            if (empty($docId)) {
                return ToolResult::error('doc_id is required.');
            }
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

            $result = $this->service->createRecords($docId, $tableId, $recordsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
