<?php

namespace OpenCompany\Integrations\Speedcurve\Tools;

use OpenCompany\Integrations\Speedcurve\SpeedcurveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpeedcurveGetSite implements Tool
{
    public function __construct(
        private SpeedcurveService $service,
    ) {}

    public function name(): string
    {
        return 'speedcurve_get_site';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific SpeedCurve site, including its URLs, test settings, and latest test results.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'integer', 'required' => true, 'description' => 'The SpeedCurve site ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SpeedCurve integration is not configured.');
            }

            if (!isset($args['site_id'])) {
                return ToolResult::error('site_id is required.');
            }

            $result = $this->service->getSite((int) $args['site_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
