<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

/**
 * Fetch the authenticated Statuspage user.
 *
 * Useful for checking whether an API key is valid before page-scoped operations.
 */
class StatuspageGetCurrentUser implements Tool
{
    /**
     * @param  StatuspageService  $service  The Statuspage API client.
     */
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Atlassian Statuspage user. Useful for verifying API credentials and checking user permissions.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the authenticated Statuspage user.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->hasApiKey()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
