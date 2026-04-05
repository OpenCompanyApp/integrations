<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Airtable record (partial update).
 */
class AirtableUpdateRecord implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_update_record';
    }

    public function description(): string
    {
        return 'Update an existing Airtable record (partial update).';
    }

    public function parameters(): array
    {
        return [
            'base_id'   => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
            'table'     => ['type' => 'string', 'required' => true, 'description' => 'Table ID or name.'],
            'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record ID (e.g., "recXXXXXXXXXXXX").'],
            'fields'    => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field name → value pairs to update.'],
        ];
    }

    /**
     * Update a record with the given field values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table, record_id, fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Airtable integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';
            $table = $args['table'] ?? '';
            $recordId = $args['record_id'] ?? '';
            $fields = $args['fields'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($recordId)) {
                return ToolResult::error('record_id is required.');
            }
            if (empty($fields)) {
                return ToolResult::error('fields is required.');
            }

            $fieldsArray = is_string($fields) ? json_decode($fields, true) : $fields;

            if (! is_array($fieldsArray)) {
                return ToolResult::error('fields must be a valid JSON object.');
            }

            $result = $this->service->updateRecord($baseId, $table, $recordId, $fieldsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
