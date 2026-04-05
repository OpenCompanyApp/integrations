<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Query a Supabase table using advanced PostgREST filter operators.
 *
 * Supports all PostgREST operators: eq, neq, gt, gte, lt, lte, like,
 * ilike, in, is, cs, cd, ov, sl, sr, nxr, nxl, adj, not, or, and.
 * Filters are provided as a JSON array of filter objects.
 */
class SupabaseQueryWithFilters implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_query_with_filters';
    }

    public function description(): string
    {
        return <<<'MD'
        Query a Supabase table using advanced PostgREST filter operators.
        Provide filters as a JSON array of objects, each with "column", "operator",
        and "value" keys. Supported operators: eq, neq, gt, gte, lt, lte, like,
        ilike, in, is, cs, cd, ov, sl, sr, nxr, nxl, adj, not, or, and.

        Example filters_json:
        [
            {"column": "status", "operator": "eq", "value": "active"},
            {"column": "age", "operator": "gte", "value": 18}
        ]
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'filters_json' => ['type' => 'string', 'required' => true, 'description' => 'JSON array of filter objects with "column", "operator", and "value" keys.'],
            'select' => ['type' => 'string', 'description' => 'Comma-separated column names (default "*").'],
            'order' => ['type' => 'string', 'description' => 'Order clause, e.g., "created_at.desc".'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of rows to return.'],
        ];
    }

    /**
     * Query a table with advanced PostgREST filter operators.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, filters_json, select, order, limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $table = $args['table'] ?? '';
            $filtersJson = $args['filters_json'] ?? '';

            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($filtersJson)) {
                return ToolResult::error('filters_json is required.');
            }

            $filters = is_string($filtersJson) ? json_decode($filtersJson, true) : $filtersJson;

            if (! is_array($filters)) {
                return ToolResult::error('filters_json must be a valid JSON array.');
            }

            // Convert filter objects to PostgREST query params
            $filterParams = [];
            foreach ($filters as $filter) {
                $column = $filter['column'] ?? '';
                $operator = $filter['operator'] ?? 'eq';
                $value = $filter['value'] ?? '';

                if (empty($column)) {
                    continue;
                }

                // Build the PostgREST filter value: operator.value
                if ($operator === 'or' || $operator === 'and') {
                    // Logical operators are passed differently
                    $filterParams[$operator] = $value;
                } else {
                    $filterParams[$column] = $operator . '.' . $value;
                }
            }

            $select = $args['select'] ?? '*';
            $order = $args['order'] ?? '';
            $limit = isset($args['limit']) ? (int) $args['limit'] : null;

            $result = $this->service->listRows($table, $select, $filterParams, $order, $limit);

            if (empty($result)) {
                return ToolResult::success('No rows matched the filters.');
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
