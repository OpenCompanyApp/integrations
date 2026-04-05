<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single NocoDB record by ID.
 */
class NocoDBGetRecord implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_get_record';
    }

    public function description(): string
    {
        return 'Get a single NocoDB record by ID.';
    }

    public function parameters(): array
    {
        return [
            'table_id'  => ['type' => 'string', 'required' => true, 'description' => 'Table ID.'],
            'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record ID.'],
            'fields'    => ['type' => 'string', 'description' => 'Comma-separated list of field names to return.'],
        ];
    }

    /**
     * Get a single record by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table_id, record_id, fields)
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

            $params = [];

            if (! empty($args['fields'])) {
                $fields = $args['fields'];
                $params['fields'] = is_string($fields) ? array_map('trim', explode(',', $fields)) : $fields;
            }

            $result = $this->service->getRecord($tableId, $recordId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
