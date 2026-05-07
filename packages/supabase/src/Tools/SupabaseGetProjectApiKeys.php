<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Supabase\SupabaseService;

/**
 * Get API keys for a Supabase project.
 */
class SupabaseGetProjectApiKeys implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase Management API client.
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_get_project_api_keys';
    }

    public function description(): string
    {
        return 'Get API keys for a Supabase project.';
    }

    public function parameters(): array
    {
        return [
            'project_ref' => ['type' => 'string', 'required' => true, 'description' => 'Project ref.'],
        ];
    }

    /**
     * Fetch project API keys.
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

            return ToolResult::success($this->service->getProjectApiKeys((string) $args['project_ref']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
