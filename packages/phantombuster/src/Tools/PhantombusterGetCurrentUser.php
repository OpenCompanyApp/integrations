<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\Integrations\Phantombuster\PhantombusterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PhantombusterGetCurrentUser implements Tool
{
    public function __construct(
        private PhantombusterService $service,
    ) {}

    public function name(): string
    {
        return 'phantombuster_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Phantombuster user profile, including account info and plan details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Phantombuster integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
