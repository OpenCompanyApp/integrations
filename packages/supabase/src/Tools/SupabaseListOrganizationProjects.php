<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Supabase\SupabaseService;

/**
 * List Supabase projects for an organization.
 */
class SupabaseListOrganizationProjects implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase Management API client.
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_list_organization_projects';
    }

    public function description(): string
    {
        return 'List Supabase projects for an organization.';
    }

    public function parameters(): array
    {
        return [
            'slug' => ['type' => 'string', 'required' => true, 'description' => 'Organization slug.'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of projects to return.'],
        ];
    }

    /**
     * Fetch organization projects with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (slug, offset, limit)
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

            $params = array_filter([
                'offset' => isset($args['offset']) ? (int) $args['offset'] : null,
                'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
            ], static fn (mixed $value): bool => $value !== null);

            return ToolResult::success($this->service->listOrganizationProjects((string) $args['slug'], $params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
