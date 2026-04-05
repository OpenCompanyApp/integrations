<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get funnel results from Mixpanel.
 *
 * Retrieves conversion data for a specific funnel within
 * a given date range, grouped by the specified time unit.
 */
class MixpanelFunnel implements Tool
{
    /**
     * @param  MixpanelService  $service  The Mixpanel API client
     */
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_funnel';
    }

    public function description(): string
    {
        return 'Get conversion funnel results for a specific funnel.';
    }

    public function parameters(): array
    {
        return [
            'funnel_id' => ['type' => 'integer', 'required' => true, 'description' => 'ID of the funnel to query.'],
            'from_date' => ['type' => 'string', 'required' => true, 'description' => 'Start date in YYYY-MM-DD format.'],
            'to_date'   => ['type' => 'string', 'required' => true, 'description' => 'End date in YYYY-MM-DD format.'],
            'unit'      => ['type' => 'string', 'description' => 'Time unit: "day", "week", or "month". Defaults to "day".'],
        ];
    }

    /**
     * Get funnel conversion data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (funnel_id, from_date, to_date, unit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $funnelId = $args['funnel_id'] ?? '';

            if (empty($funnelId)) {
                return ToolResult::error('funnel_id is required.');
            }

            $fromDate = $args['from_date'] ?? '';
            $toDate = $args['to_date'] ?? '';

            if (empty($fromDate)) {
                return ToolResult::error('from_date is required.');
            }
            if (empty($toDate)) {
                return ToolResult::error('to_date is required.');
            }

            $unit = $args['unit'] ?? 'day';

            $result = $this->service->funnel($funnelId, $fromDate, $toDate, $unit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
