<?php

namespace OpenCompany\Integrations\Actively\Tools;

use OpenCompany\Integrations\Actively\ActivelyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated user's profile from Actively.
 *
 * Returns user details including name, email, role, and associated
 * organization memberships.
 */
class ActivelyGetCurrentUser implements Tool
{
    public function __construct(
        private ActivelyService $service,
    ) {}

    public function name(): string
    {
        return 'actively_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s profile from Actively. Returns user name, email, role, and organization memberships.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Actively integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
