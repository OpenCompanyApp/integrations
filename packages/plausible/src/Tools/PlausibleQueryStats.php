<?php

namespace OpenCompany\Integrations\Plausible\Tools;

use OpenCompany\Integrations\Plausible\PlausibleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlausibleQueryStats implements Tool
{
    public function __construct(
        private PlausibleService $service,
    ) {}

    public function name(): string
    {
        return 'plausible_query_stats';
    }

    public function description(): string
    {
        return 'Query website analytics from Plausible. Supports aggregate stats, timeseries, and breakdowns by dimension. Use dimensions to group results (e.g., by country, source, page). Omit dimensions for simple aggregate totals.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The site domain (e.g., "example.com").'],
            'metrics' => ['type' => 'array', 'required' => true, 'description' => 'Metrics to retrieve: visitors, pageviews, visits, bounce_rate, visit_duration, views_per_visit, events, conversion_rate.'],
            'date_range' => ['type' => 'string', 'required' => true, 'description' => 'Time period: "7d", "28d", "30d", "month", "3mo", "6mo", "12mo", or "custom" (requires date_from/date_to).'],
            'dimensions' => ['type' => 'array', 'description' => 'Dimensions to group by: visit:source, visit:country, visit:city, visit:device, visit:browser, visit:os, event:page, event:name, time:day, time:month, etc.'],
            'filters' => ['type' => 'string', 'description' => 'JSON-encoded filter expressions, e.g., [["is", "visit:country", ["NL"]]]. Pass as a JSON string.'],
            'date_from' => ['type' => 'string', 'description' => 'Start date (ISO 8601, e.g., "2025-01-01") when date_range is "custom".'],
            'date_to' => ['type' => 'string', 'description' => 'End date (ISO 8601, e.g., "2025-01-31") when date_range is "custom".'],
            'order_by' => ['type' => 'string', 'description' => 'JSON-encoded order, e.g., [["visitors", "desc"]]. Pass as a JSON string.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return. Sent as pagination.limit (default: 10000).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plausible integration is not configured.');
            }

            $body = [
                'site_id' => $args['site_id'],
                'metrics' => $args['metrics'],
                'date_range' => $args['date_range'],
            ];

            if (isset($args['dimensions'])) {
                $body['dimensions'] = $args['dimensions'];
            }

            if (isset($args['filters'])) {
                $filters = $args['filters'];
                $body['filters'] = is_string($filters) ? json_decode($filters, true) : $filters;
            }

            if ($args['date_range'] === 'custom') {
                if (isset($args['date_from']) && isset($args['date_to'])) {
                    $body['date_range'] = [$args['date_from'], $args['date_to']];
                } else {
                    return ToolResult::error('date_from and date_to are required when date_range is "custom".');
                }
            }

            if (isset($args['order_by'])) {
                $orderBy = $args['order_by'];
                $body['order_by'] = is_string($orderBy) ? json_decode($orderBy, true) : $orderBy;
            }

            if (isset($args['limit'])) {
                $body['pagination'] = ['limit' => (int) $args['limit']];
            }

            $result = $this->service->query($body);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $result
     */
    private function formatResponse(array $result): array
    {
        $query = $result['query'] ?? [];
        $metricNames = $query['metrics'] ?? [];
        $dimensionNames = $query['dimensions'] ?? [];
        $results = $result['results'] ?? [];
        $meta = $result['meta'] ?? [];

        $rows = array_map(function (array $row) use ($metricNames, $dimensionNames) {
            $entry = [];
            foreach ($dimensionNames as $i => $dim) {
                $entry[$dim] = $row['dimensions'][$i] ?? null;
            }
            foreach ($metricNames as $i => $metric) {
                $val = $row['metrics'][$i] ?? null;
                if (is_array($val)) {
                    $entry[$metric] = $val;
                } elseif (is_numeric($val)) {
                    $entry[$metric] = str_contains((string) $val, '.') ? (float) $val : (int) $val;
                } else {
                    $entry[$metric] = $val;
                }
            }

            return $entry;
        }, $results);

        $response = [];

        if (isset($query['date_range'])) {
            $response['dateRange'] = $query['date_range'];
        }
        if (! empty($dimensionNames)) {
            $response['dimensions'] = $dimensionNames;
        }
        $response['metrics'] = $metricNames;
        $response['rows'] = $rows;
        $response['rowCount'] = count($rows);

        if (isset($meta['total_rows'])) {
            $response['totalRows'] = $meta['total_rows'];
        }

        return $response;
    }
}
