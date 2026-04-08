<?php

namespace OpenCompany\Integrations\Braze\Tools;

use OpenCompany\Integrations\Braze\BrazeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current authenticated Braze user's profile.
 *
 * Returns information about the API key owner, useful for verifying
 * credentials and understanding which Braze workspace is connected.
 *
 * @see https://www.braze.com/docs/api/endpoints/user_data/post_users_identify/
 */
class BrazeGetCurrentUser implements Tool
{
    public function __construct(
        private BrazeService $service,
    ) {}

    public function name(): string
    {
        return 'braze_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current authenticated Braze user profile. Useful for verifying credentials and identifying the connected workspace.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braze integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
