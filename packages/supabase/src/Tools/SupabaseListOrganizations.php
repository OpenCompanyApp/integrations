<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Supabase\SupabaseService;

/**
 * List Supabase organizations visible to the authenticated account.
 */
class SupabaseListOrganizations implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase Management API client.
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_list_organizations';
    }

    public function description(): string
    {
        return 'List Supabase organizations visible to the authenticated account.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Return organizations visible to the authenticated account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            return ToolResult::success($this->service->listOrganizations());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
