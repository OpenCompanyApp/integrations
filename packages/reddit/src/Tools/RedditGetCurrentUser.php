<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Reddit user's profile.
 *
 * Returns information about the authenticated user, useful for verifying
 * credentials and displaying account details.
 */
class RedditGetCurrentUser implements Tool
{
    public function __construct(
        private RedditService $service,
    ) {}

    public function name(): string
    {
        return 'reddit_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Reddit user. Useful for verifying credentials and displaying account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
