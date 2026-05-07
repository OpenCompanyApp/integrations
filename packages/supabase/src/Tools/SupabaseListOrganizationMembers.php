<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Supabase\SupabaseService;

/**
 * List members of a Supabase organization.
 */
class SupabaseListOrganizationMembers implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase Management API client.
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_list_organization_members';
    }

    public function description(): string
    {
        return 'List members of a Supabase organization.';
    }

    public function parameters(): array
    {
        return [
            'slug' => ['type' => 'string', 'required' => true, 'description' => 'Organization slug.'],
        ];
    }

    /**
     * Fetch organization members.
     *
     * @param  array<string, mixed>  $args  Tool arguments (slug)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            if (empty($args['slug'])) {
                return ToolResult::error('slug is required.');
            }

            return ToolResult::success($this->service->listOrganizationMembers((string) $args['slug']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
