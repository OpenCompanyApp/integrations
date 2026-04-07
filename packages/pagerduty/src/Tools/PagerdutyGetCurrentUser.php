<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

use OpenCompany\Integrations\Pagerduty\PagerdutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Current User.
 *
 * Retrieves the profile of the currently authenticated PagerDuty user,
 * including name, email, role, and team memberships.
 *
 * @see https://developer.pagerduty.com/api-reference/get-the-current-user
 */
class PagerdutyGetCurrentUser implements Tool
{
    /**
     * @param  PagerdutyService  $service  The PagerDuty API service instance.
     */
    public function __construct(
        private PagerdutyService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'pagerduty_get_current_user';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get the profile of the currently authenticated PagerDuty user — name, email, role, time zone, and other account details.';
    }

    /**
     * Get the tool parameter definitions.
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
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result['user'] ?? $result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
