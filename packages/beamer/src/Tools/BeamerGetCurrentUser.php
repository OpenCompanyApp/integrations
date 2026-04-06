<?php

namespace OpenCompany\Integrations\Beamer\Tools;

use OpenCompany\Integrations\Beamer\BeamerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Beamer user profile.
 *
 * Returns user details such as name, email, role, and account info.
 * Useful for verifying API credentials and identifying the connected account.
 */
class BeamerGetCurrentUser implements Tool
{
    public function __construct(
        private BeamerService $service,
    ) {}

    public function name(): string
    {
        return 'beamer_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Beamer user. Returns name, email, role, and account details. Useful for verifying credentials.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beamer integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
