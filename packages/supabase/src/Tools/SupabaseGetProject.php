<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SupabaseGetProject implements Tool
{
    /**
     * @param SupabaseService $service The Supabase service instance.
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'supabase_get_project';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Get details of a specific Supabase project by its reference ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'project_ref' => ['type' => 'string', 'required' => true, 'description' => 'The project reference ID.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array $args The tool arguments.
     * @return ToolResult The result of the tool execution.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            if (empty($args['project_ref'])) {
                return ToolResult::error('Project reference ID is required.');
            }

            $result = $this->service->getProject($args['project_ref']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
