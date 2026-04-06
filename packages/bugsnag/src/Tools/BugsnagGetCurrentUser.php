<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

use OpenCompany\Integrations\Bugsnag\BugsnagService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BugsnagGetCurrentUser implements Tool
{
    public function __construct(
        private BugsnagService $service,
    ) {}

    public function name(): string
    {
        return 'bugsnag_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Bugsnag user, including name, email, and associated organizations.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bugsnag integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
