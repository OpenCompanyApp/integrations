<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upsert a record — update if a matching record exists, otherwise create.
 *
 * Uses Airtable's performUpsert feature with the specified field(s)
 * as the merge key to determine record identity.
 */
class AirtableUpsertRecord implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_upsert_record';
    }

    public function description(): string
    {
        return 'Create or update a record based on field matching (upsert).';
    }

    public function parameters(): array
    {
        return [
            'base_id'                  => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
            'table'                    => ['type' => 'string', 'required' => true, 'description' => 'Table ID or name.'],
            'fields'                   => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field name → value pairs.'],
            'field_names_to_merge_on'  => ['type' => 'string', 'required' => true, 'description' => 'Field name(s) to match existing records. Pass a single field name as a string, or a JSON array of field names for composite matching.'],
        ];
    }

    /**
     * Upsert a record — create or update based on field matching.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table, fields, field_names_to_merge_on)
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
            $mergeOn = $args['field_names_to_merge_on'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($fields)) {
                return ToolResult::error('fields is required.');
            }
            if (empty($mergeOn)) {
                return ToolResult::error('field_names_to_merge_on is required.');
            }

            $fieldsArray = is_string($fields) ? json_decode($fields, true) : $fields;

            if (! is_array($fieldsArray)) {
                return ToolResult::error('fields must be a valid JSON object.');
            }

            // Accept either a single field name string or a JSON array of field names
            if (is_string($mergeOn)) {
                $decoded = json_decode($mergeOn, true);
                $fieldNamesToMergeOn = is_array($decoded) ? $decoded : [$mergeOn];
            } else {
                $fieldNamesToMergeOn = is_array($mergeOn) ? $mergeOn : [$mergeOn];
            }

            $result = $this->service->upsertRecord($baseId, $table, $fieldsArray, $fieldNamesToMergeOn);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
