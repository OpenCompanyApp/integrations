<?php

namespace OpenCompany\Integrations\Speedcurve\Tools;

use OpenCompany\Integrations\Speedcurve\SpeedcurveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpeedcurveGetTest implements Tool
{
    public function __construct(
        private SpeedcurveService $service,
    ) {}

    public function name(): string
    {
        return 'speedcurve_get_test';
    }

    public function description(): string
    {
        return 'Get detailed results for a specific SpeedCurve synthetic test run, including Core Web Vitals, filmstrip data, and waterfall metrics.';
    }

    public function parameters(): array
    {
        return [
            'test_id' => ['type' => 'integer', 'required' => true, 'description' => 'The SpeedCurve test ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SpeedCurve integration is not configured.');
            }

            if (!isset($args['test_id'])) {
                return ToolResult::error('test_id is required.');
            }

            $result = $this->service->getTest((int) $args['test_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
