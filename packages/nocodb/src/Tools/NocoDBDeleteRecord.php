<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a record from a NocoDB table.
 */
class NocoDBDeleteRecord implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_delete_record';
    }

    public function description(): string
    {
        return 'Delete a record from a NocoDB table.';
    }

    public function parameters(): array
    {
        return [
            'table_id'  => ['type' => 'string', 'required' => true, 'description' => 'Table ID.'],
            'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record ID.'],
        ];
    }

    /**
     * Delete a record by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table_id, record_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NocoDB integration is not configured.');
            }

            $tableId = $args['table_id'] ?? '';
            $recordId = $args['record_id'] ?? '';

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($recordId)) {
                return ToolResult::error('record_id is required.');
            }

            $this->service->deleteRecord($tableId, $recordId);

            return ToolResult::success([
                'deleted' => true,
                'record_id' => $recordId,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
