<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\Integrations\Fathom\FathomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the currently authenticated Fathom user profile.
 *
 * Returns the user's name, email, and account details. Useful for verifying
 * API connectivity and identifying which account is in use.
 */
class FathomGetCurrentUser implements Tool
{
    /**
     * Create a new FathomGetCurrentUser tool instance.
     *
     * @param  FathomService  $service  The Fathom API service instance.
     */
    public function __construct(
        private FathomService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'fathom_get_current_user';
    }

    /**
     * Get the tool description shown to AI agents.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Fathom user profile. Returns user name, email, and account details. Useful for verifying API connectivity.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the current user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
