<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the current authenticated Wufoo user's profile.
 *
 * Calls GET /users.json on the Wufoo API and returns the user's profile
 * information including name, email, and account details.
 */
class WufooGetCurrentUser implements Tool
{
    /**
     * Create a new WufooGetCurrentUser tool instance.
     *
     * @param  WufooService  $service  The Wufoo API service instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wufoo_get_current_user';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the authenticated Wufoo user\'s profile. Returns account details such as name, email, and organization.';
    }

    /**
     * Get the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> The parameter definitions.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user operation.
     *
     * @param  array<string, mixed>  $args  The tool arguments (none required).
     * @return ToolResult The result containing the user profile or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
