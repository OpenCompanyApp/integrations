<?php

namespace OpenCompany\Integrations\Speedcurve\Tools;

use OpenCompany\Integrations\Speedcurve\SpeedcurveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpeedcurveListSites implements Tool
{
    public function __construct(
        private SpeedcurveService $service,
    ) {}

    public function name(): string
    {
        return 'speedcurve_list_sites';
    }

    public function description(): string
    {
        return 'List all monitored sites in SpeedCurve. Returns site IDs, names, and URLs that you can use to query test results.';
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

            $result = $this->service->listSites();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
