<?php

namespace OpenCompany\Integrations\Speedcurve\Tools;

use OpenCompany\Integrations\Speedcurve\SpeedcurveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpeedcurveGetCurrentUser implements Tool
{
    public function __construct(
        private SpeedcurveService $service,
    ) {}

    public function name(): string
    {
        return 'speedcurve_get_current_user';
    }

    public function description(): string
    {
        return 'Get details about the currently authenticated SpeedCurve user. Useful for verifying API credentials and checking account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SpeedCurve integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
