<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the OpenAPI spec info for the Supabase PostgREST instance.
 *
 * Queries the root endpoint (/) with no table specified to retrieve
 * the PostgREST OpenAPI specification and database information.
 */
class SupabaseGetSettings implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_get_settings';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the OpenAPI spec info for the Supabase PostgREST instance.
        Returns database metadata, available tables, and schema information.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve PostgREST settings and OpenAPI spec.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $result = $this->service->listTables();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
