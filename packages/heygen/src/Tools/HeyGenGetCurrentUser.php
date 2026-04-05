<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving the current authenticated HeyGen user's account information.
 *
 * Returns the user's profile, plan details, remaining credits, and usage
 * statistics.
 */
class HeyGenGetCurrentUser implements Tool
{
    /**
     * Create a new HeyGenGetCurrentUser tool instance.
     *
     * @param  HeyGenService  $service  The HeyGen API service.
     */
    public function __construct(
        private HeyGenService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'heygen_get_current_user';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Retrieve the authenticated HeyGen user\'s account information, including plan details, remaining credits, and usage.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user tool.
     *
     * @param  array  $args  The tool arguments (none required).
     * @return ToolResult The result containing the user info or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
