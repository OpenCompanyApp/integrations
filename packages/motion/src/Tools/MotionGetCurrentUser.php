<?php

namespace OpenCompany\Integrations\Motion\Tools;

use OpenCompany\Integrations\Motion\MotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MotionGetCurrentUser implements Tool
{
    public function __construct(
        private MotionService $service,
    ) {}

    public function name(): string
    {
        return 'motion_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Motion user. Returns user ID, name, email, and other account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Motion integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
