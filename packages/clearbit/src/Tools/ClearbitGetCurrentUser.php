<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

use OpenCompany\Integrations\Clearbit\ClearbitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clearbit_get_current_user
 *
 * Retrieves the authenticated user's Clearbit account information.
 * Useful for verifying API credentials and checking plan limits.
 *
 * Endpoint: GET /users/me
 */
class ClearbitGetCurrentUser implements Tool
{
    /**
     * @param  ClearbitService  $service  The Clearbit API service instance.
     */
    public function __construct(
        private ClearbitService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'clearbit_get_current_user';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the authenticated user\'s Clearbit account information. Useful for verifying API credentials and checking plan details.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the current user lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     * @return ToolResult The current user's account data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clearbit integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
