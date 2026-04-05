<?php

namespace OpenCompany\Integrations\Lemlist\Tools;

use OpenCompany\Integrations\Lemlist\LemlistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get the current authenticated Lemlist user profile.
 *
 * Returns user details including name, email, plan, and account information.
 */
class LemlistGetCurrentUser implements Tool
{
    public function __construct(
        private LemlistService $service,
    ) {}

    public function name(): string
    {
        return 'lemlist_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Lemlist user. Returns name, email, plan, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemlist integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
