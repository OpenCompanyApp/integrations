<?php

namespace OpenCompany\Integrations\Grist\Tools;

use OpenCompany\Integrations\Grist\GristService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete records from a Grist table by row IDs.
 */
class GristDeleteRecords implements Tool
{
    /**
     * @param  GristService  $service  The Grist API client
     */
    public function __construct(
        private GristService $service,
    ) {}

    public function name(): string
    {
        return 'grist_delete_records';
    }

    public function description(): string
    {
        return 'Delete records from a Grist table by row IDs.';
    }

    public function parameters(): array
    {
        return [
            'doc_id'     => ['type' => 'string', 'required' => true, 'description' => 'Grist document ID.'],
            'table_id'   => ['type' => 'string', 'required' => true, 'description' => 'Grist table ID.'],
            'record_ids' => ['type' => 'string', 'required' => true, 'description' => 'JSON array of row IDs to delete (e.g., [1, 2, 3]).'],
        ];
    }

    /**
     * Delete records from a table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (doc_id, table_id, record_ids)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Grist integration is not configured.');
            }

            $docId = $args['doc_id'] ?? '';
            $tableId = $args['table_id'] ?? '';
            $recordIds = $args['record_ids'] ?? '';

            if (empty($docId)) {
                return ToolResult::error('doc_id is required.');
            }
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

            $result = $this->service->deleteRecords($docId, $tableId, $idsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
