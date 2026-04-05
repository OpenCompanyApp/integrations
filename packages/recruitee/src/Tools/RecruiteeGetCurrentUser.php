<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

use OpenCompany\Integrations\Recruitee\RecruiteeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RecruiteeGetCurrentUser implements Tool
{
    /**
     * Create a new RecruiteeGetCurrentUser tool instance.
     */
    public function __construct(
        private RecruiteeService $service,
    ) {}

    /**
     * Get the tool name (slug).
     */
    public function name(): string
    {
        return 'recruitee_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Recruitee user. Returns user profile info including name, email, and role.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recruitee integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
