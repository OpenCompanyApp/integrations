<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Query Mixpanel event data.
 *
 * Retrieves event analytics data for a given date range,
 * with support for event filtering, query type, and time-unit grouping.
 */
class MixpanelQuery implements Tool
{
    /**
     * @param  MixpanelService  $service  The Mixpanel API client
     */
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_query';
    }

    public function description(): string
    {
        return 'Query Mixpanel event data with date range, type, and time unit.';
    }

    public function parameters(): array
    {
        return [
            'from_date' => ['type' => 'string', 'required' => true, 'description' => 'Start date in YYYY-MM-DD format.'],
            'to_date'   => ['type' => 'string', 'required' => true, 'description' => 'End date in YYYY-MM-DD format.'],
            'event'     => ['type' => 'string', 'description' => 'Event name or JSON array of event names (e.g., "Page View" or \'["Page View","Signup"]\').'],
            'type'      => ['type' => 'string', 'description' => 'Query type: "general" (total events), "unique" (unique users), or "average". Defaults to "general".'],
            'unit'      => ['type' => 'string', 'description' => 'Time unit for grouping: "minute", "hour", "day", "week", "month". Defaults to "day".'],
        ];
    }

    /**
     * Query event analytics data from Mixpanel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (from_date, to_date, event, type, unit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $fromDate = $args['from_date'] ?? '';
            $toDate = $args['to_date'] ?? '';

            if (empty($fromDate)) {
                return ToolResult::error('from_date is required.');
            }
            if (empty($toDate)) {
                return ToolResult::error('to_date is required.');
            }

            $event = $args['event'] ?? [];
            if (is_string($event)) {
                $decoded = json_decode($event, true);
                $event = is_array($decoded) ? $decoded : [$event];
            }

            $type = $args['type'] ?? 'general';
            $unit = $args['unit'] ?? 'day';

            $result = $this->service->query($fromDate, $toDate, $event, $type, $unit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
