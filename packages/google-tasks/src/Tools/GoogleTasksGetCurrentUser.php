<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

use OpenCompany\Integrations\GoogleTasks\GoogleTasksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleTasksGetCurrentUser implements Tool
{
    public function __construct(
        private GoogleTasksService $service,
    ) {}

    public function name(): string
    {
        return 'gtasks_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Google user. Useful for verifying the connected account.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Tasks integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
