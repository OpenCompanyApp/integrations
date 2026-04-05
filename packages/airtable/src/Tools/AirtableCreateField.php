<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new field in an Airtable table.
 *
 * Supports all Airtable field types with optional type-specific options.
 */
class AirtableCreateField implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_create_field';
    }

    public function description(): string
    {
        return 'Create a new field in an Airtable table.';
    }

    public function parameters(): array
    {
        return [
            'base_id'     => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
            'table_id'    => ['type' => 'string', 'required' => true, 'description' => 'Table ID (e.g., "tblXXXXXXXXXXXX").'],
            'name'        => ['type' => 'string', 'required' => true, 'description' => 'Name for the new field.'],
            'type'        => ['type' => 'string', 'required' => true, 'description' => 'Airtable field type (e.g., "singleLineText", "number", "email", "dateTime", "singleSelect", "multipleSelects", "checkbox", "url", "phoneNumber", "currency", "percent", "duration", "richText", "autoNumber", "barcode").'],
            'description' => ['type' => 'string', 'description' => 'Optional description for the field.'],
            'options'     => ['type' => 'string', 'description' => 'JSON object of field-type-specific options (e.g., {"precision": 2} for number fields, {"choices":[{"name":"Option A"}]} for select fields).'],
        ];
    }

    /**
     * Create a new field in the specified table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table_id, name, type, description, options)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Airtable integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';
            $tableId = $args['table_id'] ?? '';
            $name = $args['name'] ?? '';
            $type = $args['type'] ?? '';
            $description = $args['description'] ?? '';
            $options = $args['options'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }
            if (empty($type)) {
                return ToolResult::error('type is required.');
            }

            $optionsArray = [];
            if (! empty($options)) {
                $optionsArray = is_string($options) ? json_decode($options, true) : $options;
                if (! is_array($optionsArray)) {
                    return ToolResult::error('options must be a valid JSON object.');
                }
            }

            $result = $this->service->createField($baseId, $tableId, $name, $type, $description, $optionsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
