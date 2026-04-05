<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Count rows in a Supabase table with optional filtering.
 *
 * Uses the PostgREST Prefer: count=exact header and select=count
 * to retrieve the total number of matching rows.
 */
class SupabaseCountRows implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_count_rows';
    }

    public function description(): string
    {
        return <<<'MD'
        Count rows in a Supabase table, optionally filtered by PostgREST filter
        syntax. Returns the total count of matching rows. Example filter:
        {"status": "eq.active", "created_at": "gte.2024-01-01"}.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'filter' => ['type' => 'string', 'description' => 'JSON object of PostgREST filter params, e.g. {"status": "eq.active"}.'],
        ];
    }

    /**
     * Count rows in the specified table with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, filter)
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

            $result = $this->service->countRows($table, $filter);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
