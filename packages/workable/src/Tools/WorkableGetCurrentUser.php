<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve the currently authenticated Workable user's profile.
 *
 * Returns user details including name, email, and account role.
 */
class WorkableGetCurrentUser implements Tool
{
    /**
     * Create a new WorkableGetCurrentUser tool instance.
     */
    public function __construct(
        private WorkableService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'workable_get_current_user';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the currently authenticated user\'s profile from Workable. Useful for verifying the connection and understanding which account is active.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user request.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
