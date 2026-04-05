<?php

namespace OpenCompany\Integrations\Gong\Tools;

use OpenCompany\Integrations\Gong\GongService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving the currently authenticated Gong user.
 *
 * Fetches the profile of the user associated with the configured
 * API credentials via the GET /v2/users/me endpoint.
 */
class GongGetCurrentUser implements Tool
{
    /**
     * Create a new GongGetCurrentUser tool instance.
     */
    public function __construct(
        private GongService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gong_get_current_user';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Gong user profile. Useful for verifying credentials and understanding whose data is being accessed.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user tool.
     *
     * @param  array  $args  Tool arguments (none required).
     * @return ToolResult The result containing the current user profile or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gong integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
