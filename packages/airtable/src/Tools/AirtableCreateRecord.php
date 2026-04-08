<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new record in an Airtable table.
 */
class AirtableCreateRecord implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_create_record';
    }

    public function description(): string
    {
        return 'Create a new record in an Airtable table.';
    }

    public function parameters(): array
    {
        return [
            'base_id' => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
            'table'   => ['type' => 'string', 'required' => true, 'description' => 'Table ID or name.'],
            'fields'  => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field name → value pairs (e.g., {"Name":"John","Age":30}).'],
        ];
    }

    /**
     * Create a new record with the given field values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table, fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Airtable integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';
            $table = $args['table'] ?? '';
            $fields = $args['fields'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($fields)) {
                return ToolResult::error('fields is required.');
            }

            $fieldsArray = is_string($fields) ? json_decode($fields, true) : $fields;

            if (! is_array($fieldsArray)) {
                return ToolResult::error('fields must be a valid JSON object.');
            }

            $result = $this->service->createRecord($baseId, $table, $fieldsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
