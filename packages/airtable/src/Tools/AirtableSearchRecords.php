<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search records in an Airtable table using a formula expression.
 *
 * A convenience wrapper around list records that focuses on
 * filterByFormula-based searching.
 */
class AirtableSearchRecords implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_search_records';
    }

    public function description(): string
    {
        return 'Search records in an Airtable table using an Airtable formula expression.';
    }

    public function parameters(): array
    {
        return [
            'base_id'           => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
            'table'             => ['type' => 'string', 'required' => true, 'description' => 'Table ID or name.'],
            'filter_by_formula' => ['type' => 'string', 'required' => true, 'description' => 'Airtable formula expression (e.g., "{Email} = \'user@example.com\'", "AND({Status} = \'Active\', {Score} > 50)").'],
            'max_records'       => ['type' => 'integer', 'description' => 'Maximum number of records to return.'],
        ];
    }

    /**
     * Search records using a filterByFormula expression.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table, filter_by_formula, max_records)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Airtable integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';
            $table = $args['table'] ?? '';
            $filterByFormula = $args['filter_by_formula'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($filterByFormula)) {
                return ToolResult::error('filter_by_formula is required.');
            }

            $params = [
                'filterByFormula' => $filterByFormula,
            ];

            if (isset($args['max_records'])) {
                $params['maxRecords'] = (int) $args['max_records'];
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
