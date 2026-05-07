<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

use OpenCompany\Integrations\Openrouter\OpenrouterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current authenticated user's profile.
 *
 * Sends a GET request to /auth/key and returns the user profile
 * data including account information and key metadata.
 *
 * @see https://openrouter.ai/docs/api-reference/get-current-user
 */
class OpenrouterGetCurrentUser implements Tool
{
    /**
     * @param  OpenrouterService  $service  The OpenRouter service instance.
     */
    public function __construct(
        private OpenrouterService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'openrouter_get_current_user';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the authenticated user\'s profile and account information.';
    }

    /**
     * Parameter schema; no parameters required.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user request.
     *
     * @param  array  $args  No parameters required.
     * @return ToolResult The user profile or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OpenRouter integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
