<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\Integrations\Fathom\FathomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get aggregated analytics data from Fathom.
 *
 * Returns aggregated metrics (pageviews, visits, uniques, bounce rate, etc.) for a site
 * within a date range. Supports grouping by dimensions like page path, country, or device type.
 */
class FathomGetAggregate implements Tool
{
    /**
     * Create a new FathomGetAggregate tool instance.
     *
     * @param  FathomService  $service  The Fathom API service instance.
     */
    public function __construct(
        private FathomService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'fathom_get_aggregate';
    }

    /**
     * Get the tool description shown to AI agents.
     */
    public function description(): string
    {
        return 'Get aggregated analytics data from Fathom. Supports pageviews, visits, uniques, bounce rate, and more. Can group results by page, country, browser, device type, etc.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The Fathom site ID (e.g., "CDCLS").'],
            'date_from' => ['type' => 'string', 'description' => 'Start timestamp, e.g. "2025-01-01 00:00:00".'],
            'date_to' => ['type' => 'string', 'description' => 'End timestamp, e.g. "2025-01-31 23:59:59".'],
            'metrics' => ['type' => 'string', 'description' => 'Comma-separated aggregates. Pageview values: visits, uniques, pageviews, avg_duration, bounce_rate.'],
            'group_by' => ['type' => 'string', 'description' => 'Comma-separated field grouping: hostname, pathname, referrer_hostname, country_code, browser, device_type, utm_source, etc.'],
            'sort_by' => ['type' => 'string', 'description' => 'Sort field and direction (e.g., "pageviews:desc", "uniques:asc").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of grouped results to return.'],
            'date_grouping' => ['type' => 'string', 'description' => 'Optional date grouping: hour, day, month, or year.'],
            'timezone' => ['type' => 'string', 'description' => 'TZ database timezone such as UTC or Europe/Brussels.'],
            'filters' => ['type' => 'string', 'description' => 'JSON array of Fathom aggregation filters.'],
        ];
    }

    /**
     * Execute the tool and return aggregated analytics data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, date_from, date_to, metrics, group_by, sort_by, limit, date_grouping, timezone, filters).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            $siteId = $args['site_id'] ?? '';
            $dateFrom = $args['date_from'] ?? '';
            $dateTo = $args['date_to'] ?? '';

            if (empty($siteId)) {
                return ToolResult::error('site_id is required.');
            }
            $result = $this->service->getAggregate(
                siteId: $siteId,
                dateFrom: $dateFrom ?: null,
                dateTo: $dateTo ?: null,
                metrics: $args['metrics'] ?? null,
                sortBy: $args['sort_by'] ?? null,
                groupBy: $args['group_by'] ?? null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                dateGrouping: $args['date_grouping'] ?? null,
                timezone: $args['timezone'] ?? null,
                filters: $args['filters'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
