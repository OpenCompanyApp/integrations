<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing NocoDB record.
 */
class NocoDBUpdateRecord implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_update_record';
    }

    public function description(): string
    {
        return 'Update an existing NocoDB record.';
    }

    public function parameters(): array
    {
        return [
            'table_id'  => ['type' => 'string', 'required' => true, 'description' => 'Table ID.'],
            'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record ID.'],
            'data'      => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field name → value pairs to update (e.g., {"Status":"Done"}).'],
        ];
    }

    /**
     * Update an existing record with the given field values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table_id, record_id, data)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NocoDB integration is not configured.');
            }

            $tableId = $args['table_id'] ?? '';
            $recordId = $args['record_id'] ?? '';
            $data = $args['data'] ?? '';

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($recordId)) {
                return ToolResult::error('record_id is required.');
            }
            if (empty($data)) {
                return ToolResult::error('data is required.');
            }

            $dataArray = is_string($data) ? json_decode($data, true) : $data;

            if (! is_array($dataArray)) {
                return ToolResult::error('data must be a valid JSON object.');
            }

            $result = $this->service->updateRecord($tableId, $recordId, $dataArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
