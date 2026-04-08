<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChartMogulGetMetrics implements Tool
{
    public function __construct(
        private ChartMogulService $service,
    ) {}

    public function name(): string
    {
        return 'chartmogul_get_metrics';
    }

    public function description(): string
    {
        return 'Query subscription analytics metrics from ChartMogul. Returns key metrics like MRR, ARR, churn rate, customer count, and more. Specify a date range and interval for timeseries data.';
    }

    public function parameters(): array
    {
        return [
            'start_date' => ['type' => 'string', 'required' => true, 'description' => 'Start date for the metrics period (ISO 8601, e.g. "2025-01-01").'],
            'end_date' => ['type' => 'string', 'required' => true, 'description' => 'End date for the metrics period (ISO 8601, e.g. "2025-01-31").'],
            'interval' => ['type' => 'string', 'description' => 'Interval for grouping results: "day", "week", or "month" (default: "month").'],
            'type' => ['type' => 'string', 'description' => 'Type of metrics to return: "absolute" or "percentage". Omit for default.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            $startDate = $args['start_date'];
            $endDate = $args['end_date'];
            $interval = $args['interval'] ?? 'month';
            $type = $args['type'] ?? null;

            $result = $this->service->getMetrics($startDate, $endDate, $interval, $type);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
