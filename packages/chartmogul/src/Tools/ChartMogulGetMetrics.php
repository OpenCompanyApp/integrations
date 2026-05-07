<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve ChartMogul all-key subscription metrics.
 */
class ChartMogulGetMetrics implements Tool
{
    /**
     * @param  ChartMogulService  $service  The ChartMogul API client.
     */
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
            'interval' => ['type' => 'string', 'description' => 'Interval for grouping results: "day", "week", "month", "quarter", or "year" (default: "month").'],
            'geo' => ['type' => 'string', 'description' => 'Comma-separated ISO country codes, e.g. US,GB,DE.'],
            'plans' => ['type' => 'string', 'description' => 'Comma-separated plan UUIDs, external IDs, or names.'],
            'filters' => ['type' => 'string', 'description' => 'ChartMogul advanced filter expression.'],
        ];
    }

    /**
     * Retrieve all key metrics through the ChartMogul API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (start_date, end_date, interval, geo, plans, filters).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            if (!isset($args['start_date']) || !isset($args['end_date'])) {
                return ToolResult::error('start_date and end_date are required.');
            }

            $startDate = $args['start_date'];
            $endDate = $args['end_date'];
            $interval = $args['interval'] ?? 'month';

            $result = $this->service->getMetrics(
                $startDate,
                $endDate,
                $interval,
                $args['geo'] ?? null,
                $args['plans'] ?? null,
                $args['filters'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
