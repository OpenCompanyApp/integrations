<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List rows from a Supabase table with optional filtering, ordering, and pagination.
 */
class SupabaseListRows implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_list_rows';
    }

    public function description(): string
    {
        return <<<'MD'
        List rows from a Supabase table. Supports column selection, filtering,
        ordering, and pagination. Filters use PostgREST syntax (e.g., "eq.value",
        "like.*pattern*"). Example filter: {"status": "eq.active", "name": "like.*john*"}.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'select' => ['type' => 'string', 'description' => 'Comma-separated column names (default "*").'],
            'filter' => ['type' => 'string', 'description' => 'JSON object of PostgREST filter params, e.g. {"status": "eq.active"}.'],
            'order' => ['type' => 'string', 'description' => 'Order clause, e.g., "created_at.desc.nullsfirst".'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of rows to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of rows to skip.'],
            'count' => ['type' => 'string', 'description' => 'Count mode: "exact" or "planned".'],
        ];
    }

    /**
     * List rows from the specified table with optional filters and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, select, filter, order, limit, offset, count)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $table = $args['table'] ?? '';
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }

            $select = $args['select'] ?? '*';
            $order = $args['order'] ?? '';
            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $offset = isset($args['offset']) ? (int) $args['offset'] : null;
            $count = $args['count'] ?? null;

            $filter = [];
            if (isset($args['filter'])) {
                $raw = $args['filter'];
                if (is_string($raw)) {
                    $decoded = json_decode($raw, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return ToolResult::error('Invalid JSON in filter: ' . json_last_error_msg());
                    }
                    $filter = $decoded;
                } elseif (is_array($raw)) {
                    $filter = $raw;
                }
            }

            $result = $this->service->listRows($table, $select, $filter, $order, $limit, $offset, $count);

            if (empty($result)) {
                return ToolResult::success('No rows found.');
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
