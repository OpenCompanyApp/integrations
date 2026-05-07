<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Supabase\SupabaseService;

/**
 * Delete a Supabase project by project ref.
 */
class SupabaseDeleteProject implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase Management API client.
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_delete_project';
    }

    public function description(): string
    {
        return 'Delete a Supabase project by project ref.';
    }

    public function parameters(): array
    {
        return [
            'project_ref' => ['type' => 'string', 'required' => true, 'description' => 'Project ref.'],
        ];
    }

    /**
     * Delete a project and return the Supabase response.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_ref)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            if (empty($args['project_ref'])) {
                return ToolResult::error('project_ref is required.');
            }

            return ToolResult::success($this->service->deleteProject((string) $args['project_ref']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
