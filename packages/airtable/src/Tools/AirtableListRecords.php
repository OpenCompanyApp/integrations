<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List records from an Airtable table.
 *
 * Supports filtering by formula, sorting, field selection,
 * view-based filtering, and offset-based pagination.
 */
class AirtableListRecords implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_list_records';
    }

    public function description(): string
    {
        return 'List records from an Airtable table with optional filtering, sorting, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'base_id'          => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
            'table'            => ['type' => 'string', 'required' => true, 'description' => 'Table ID or name.'],
            'view'             => ['type' => 'string', 'description' => 'View name or ID to filter records by the view\'s filters.'],
            'filter_by_formula' => ['type' => 'string', 'description' => 'Airtable formula expression to filter records (e.g., "{Status} = \'Done\'").'],
            'max_records'      => ['type' => 'integer', 'description' => 'Maximum number of records to return.'],
            'offset'           => ['type' => 'string', 'description' => 'Pagination offset from a previous response.'],
            'fields'           => ['type' => 'string', 'description' => 'Comma-separated list of field names to return.'],
            'sort'             => ['type' => 'string', 'description' => 'JSON array of sort objects, e.g. [{"field":"Name","direction":"asc"}].'],
        ];
    }

    /**
     * List records from a table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table, view, filter_by_formula, max_records, offset, fields, sort)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Airtable integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';
            $table = $args['table'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }

            $params = [];

            if (! empty($args['view'])) {
                $params['view'] = $args['view'];
            }
            if (! empty($args['filter_by_formula'])) {
                $params['filterByFormula'] = $args['filter_by_formula'];
            }
            if (isset($args['max_records'])) {
                $params['maxRecords'] = (int) $args['max_records'];
            }
            if (! empty($args['offset'])) {
                $params['offset'] = $args['offset'];
            }
            if (! empty($args['fields'])) {
                $fields = $args['fields'];
                $params['fields'] = is_string($fields) ? array_map('trim', explode(',', $fields)) : $fields;
            }
            if (! empty($args['sort'])) {
                $sort = $args['sort'];
                $params['sort'] = is_string($sort) ? json_decode($sort, true) : $sort;
            }

            $result = $this->service->listRecords($baseId, $table, $params);

            return ToolResult::success([
                'records' => $result['records'] ?? [],
                'offset' => $result['offset'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
