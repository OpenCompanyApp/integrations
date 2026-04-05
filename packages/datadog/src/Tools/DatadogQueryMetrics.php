<?php

namespace OpenCompany\Integrations\Datadog\Tools;

use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to query Datadog metrics for a given time range.
 *
 * Supports all Datadog query syntax including aggregation, filtering by tags,
 * and mathematical functions.
 */
class DatadogQueryMetrics implements Tool
{
    /**
     * Create a new DatadogQueryMetrics tool instance.
     *
     * @param  DatadogService  $service  The Datadog API service
     */
    public function __construct(
        private DatadogService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'datadog_query_metrics';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Query Datadog metrics between two timestamps. Use Datadog query syntax (e.g., "avg:system.cpu.user{env:production} by {host}"). Returns time series data points.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'from' => ['type' => 'integer', 'required' => true, 'description' => 'Start time as Unix timestamp in seconds (e.g., 1710000000). Use current time minus seconds for relative ranges.'],
            'to' => ['type' => 'integer', 'required' => true, 'description' => 'End time as Unix timestamp in seconds. Use current time for "now".'],
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Datadog metric query string (e.g., "avg:system.cpu.user{env:production} by {host}").'],
        ];
    }

    /**
     * Execute the tool and return the metric query results.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Datadog integration is not configured.');
            }

            $from = (int) $args['from'];
            $to = (int) $args['to'];
            $query = $args['query'];

            if ($from >= $to) {
                return ToolResult::error('The "from" timestamp must be less than the "to" timestamp.');
            }

            $result = $this->service->queryMetrics($from, $to, $query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
