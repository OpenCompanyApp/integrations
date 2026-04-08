<?php

namespace OpenCompany\Integrations\Wise\Tools;

use OpenCompany\Integrations\Wise\WiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the currently authenticated Wise user.
 *
 * Returns user details including name, email, and account information
 * for the Wise API token owner.
 */
class WiseGetCurrentUser implements Tool
{
    /**
     * Create a new WiseGetCurrentUser instance.
     *
     * @param WiseService $service The Wise API service client.
     */
    public function __construct(
        private WiseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'wise_get_current_user';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Get details of the currently authenticated Wise user.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — get current user info.
     *
     * @param array $args Tool arguments (none required).
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wise integration is not configured.');
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
