<?php

namespace OpenCompany\Integrations\Speedcurve\Tools;

use OpenCompany\Integrations\Speedcurve\SpeedcurveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpeedcurveListDeployments implements Tool
{
    public function __construct(
        private SpeedcurveService $service,
    ) {}

    public function name(): string
    {
        return 'speedcurve_list_deployments';
    }

    public function description(): string
    {
        return 'List recent deployments in SpeedCurve and their performance impact. Shows how each deploy affected Core Web Vitals and load times.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'integer', 'description' => 'Filter deployments by site ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of deployments to return.'],
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
                'limit' => $args['limit'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listDeployments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
