<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated user from Supabase Auth.
 *
 * Queries the Supabase Auth endpoint ({projectUrl}/auth/v1/user)
 * to retrieve user details for the current bearer token.
 */
class SupabaseGetCurrentUser implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the currently authenticated user from Supabase Auth.
        Returns the user profile associated with the configured bearer token.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the current authenticated user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
