<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new record in a NocoDB table.
 */
class NocoDBCreateRecord implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_create_record';
    }

    public function description(): string
    {
        return 'Create a new record in a NocoDB table.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'Table ID.'],
            'data'     => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field name → value pairs (e.g., {"Name":"John","Age":30}).'],
        ];
    }

    /**
     * Create a new record with the given field values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table_id, data)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NocoDB integration is not configured.');
            }

            $tableId = $args['table_id'] ?? '';
            $data = $args['data'] ?? '';

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($data)) {
                return ToolResult::error('data is required.');
            }

            $dataArray = is_string($data) ? json_decode($data, true) : $data;

            if (! is_array($dataArray)) {
                return ToolResult::error('data must be a valid JSON object.');
            }

            $result = $this->service->createRecord($tableId, $dataArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
