<?php

namespace OpenCompany\Integrations\Speedcurve\Tools;

use OpenCompany\Integrations\Speedcurve\SpeedcurveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpeedcurveListTests implements Tool
{
    public function __construct(
        private SpeedcurveService $service,
    ) {}

    public function name(): string
    {
        return 'speedcurve_list_tests';
    }

    public function description(): string
    {
        return 'List recent synthetic test results from SpeedCurve. Optionally filter by site, browser, or region.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'integer', 'description' => 'Filter tests by site ID.'],
            'url_id' => ['type' => 'integer', 'description' => 'Filter tests by URL ID.'],
            'browser' => ['type' => 'string', 'description' => 'Filter by browser (e.g., "Chrome", "Firefox").'],
            'region' => ['type' => 'string', 'description' => 'Filter by region (e.g., "us-east-1", "eu-west-1").'],
            'days' => ['type' => 'integer', 'description' => 'Number of days of test history to return.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SpeedCurve integration is not configured.');
            }

            $params = array_filter([
                'site_id' => $args['site_id'] ?? null,
                'url_id' => $args['url_id'] ?? null,
                'browser' => $args['browser'] ?? null,
                'region' => $args['region'] ?? null,
                'days' => $args['days'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listTests($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
