<?php

namespace OpenCompany\Integrations\SproutSocial\Tools;

use OpenCompany\Integrations\SproutSocial\SproutSocialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Sprout Social user.
 *
 * Returns the profile of the authenticated user, including
 * name, email, and account details.
 */
class SproutSocialGetCurrentUser implements Tool
{
    public function __construct(
        private SproutSocialService $service,
    ) {}

    public function name(): string
    {
        return 'sproutsocial_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Sprout Social user profile. Returns the user name, email, and account info.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sprout Social integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
