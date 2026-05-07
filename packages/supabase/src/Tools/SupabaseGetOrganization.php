<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Supabase\SupabaseService;

/**
 * Get a Supabase organization by slug.
 */
class SupabaseGetOrganization implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase Management API client.
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_get_organization';
    }

    public function description(): string
    {
        return 'Get a Supabase organization by slug.';
    }

    public function parameters(): array
    {
        return [
            'slug' => ['type' => 'string', 'required' => true, 'description' => 'Organization slug.'],
        ];
    }

    /**
     * Fetch an organization and return the Supabase response.
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

            return ToolResult::success($this->service->getOrganization((string) $args['slug']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
