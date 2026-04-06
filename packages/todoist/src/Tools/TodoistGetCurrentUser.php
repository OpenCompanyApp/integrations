<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * Retrieve the current Todoist user's profile information.
 *
 * Returns user details including full name, email, avatar, and plan type.
 * Useful for verifying the connection and displaying account information.
 */
class TodoistGetCurrentUser implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current Todoist user profile including name, email, and account plan details.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the current user's profile.
     *
     * @param array<string, mixed> $args No parameters required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
