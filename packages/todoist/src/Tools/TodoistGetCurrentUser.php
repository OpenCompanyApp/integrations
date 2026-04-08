<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Todoist\TodoistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TodoistGetCurrentUser implements Tool
{
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string { return 'todoist_get_current_user'; }
    public function description(): string { return 'Get the currently authenticated Todoist user.'; }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }
            $user = $this->service->getCurrentUser();
            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
