<?php

namespace OpenCompany\Integrations\Autopilot\Tools;

use OpenCompany\Integrations\Autopilot\AutopilotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated user's Autopilot account details.
 */
class AutopilotGetCurrentUser implements Tool
{
    public function __construct(
        private AutopilotService $service,
    ) {}

    public function name(): string
    {
        return 'autopilot_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s Autopilot account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Autopilot integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
