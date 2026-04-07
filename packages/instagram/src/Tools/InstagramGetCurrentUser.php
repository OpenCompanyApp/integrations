<?php

namespace OpenCompany\Integrations\Instagram\Tools;

use OpenCompany\Integrations\Instagram\InstagramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Instagram user profile.
 *
 * Retrieves the user's ID, username, name, account type,
 * media count, and follower/following counts.
 */
class InstagramGetCurrentUser implements Tool
{
    public function __construct(
        private InstagramService $service,
    ) {}

    public function name(): string
    {
        return 'instagram_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Instagram user profile. Returns user ID, username, name, account type, media count, and follower/following counts.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instagram integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
