<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

use OpenCompany\Integrations\CircleCI\CircleCIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current authenticated CircleCI user profile.
 *
 * Returns the user's login, name, and account information.
 * Useful for verifying that the API token is valid and belongs
 * to the expected user.
 */
class CircleCIGetCurrentUser implements Tool
{
    public function __construct(
        private CircleCIService $service,
    ) {}

    public function name(): string
    {
        return 'circleci_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current authenticated CircleCI user profile. Returns login, name, and account details. Useful for verifying API token validity.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CircleCI integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
