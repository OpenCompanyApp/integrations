<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a raw SQL query via the Supabase exec_sql RPC function.
 */
class SupabaseQuerySql implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_query_sql';
    }

    public function description(): string
    {
        return <<<'MD'
        Execute a raw SQL query on the Supabase database via the exec_sql RPC function.
        Note: This requires the exec_sql function to be defined in the Supabase database.
        Use for advanced queries that cannot be expressed through standard PostgREST filters.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'SQL query string to execute.'],
        ];
    }

    /**
     * Execute a raw SQL query via the exec_sql RPC function.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $query = $args['query'] ?? '';
            if (empty($query)) {
                return ToolResult::error('query is required.');
            }

            $result = $this->service->querySql($query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
