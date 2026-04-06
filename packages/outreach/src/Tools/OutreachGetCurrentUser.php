<?php

namespace OpenCompany\Integrations\Outreach\Tools;

use OpenCompany\Integrations\Outreach\OutreachService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OutreachGetCurrentUser implements Tool
{
    /**
     * Create a new OutreachGetCurrentUser tool instance.
     *
     * @param OutreachService $service The Outreach API service.
     */
    public function __construct(
        private OutreachService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string The tool name.
     */
    public function name(): string
    {
        return 'outreach_get_current_user';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Outreach user. Returns user profile details including name, email, and role.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — get the current user from Outreach.
     *
     * @param  array $args No parameters required.
     * @return ToolResult The result containing the current user data or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Outreach integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
