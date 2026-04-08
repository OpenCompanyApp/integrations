<?php

namespace OpenCompany\Integrations\Teachable\Tools;

use OpenCompany\Integrations\Teachable\TeachableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to verify Teachable authentication and get the current user profile.
 *
 * Primarily used for connection testing and verifying that the API key is valid.
 */
class TeachableGetCurrentUser implements Tool
{
    /**
     * Create a new TeachableGetCurrentUser tool instance.
     */
    public function __construct(
        private TeachableService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'teachable_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Verify your Teachable API key and get the current user profile. Use this to confirm the integration is working.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — get current user from Teachable.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
