<?php

namespace OpenCompany\Integrations\Cursor\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cursor\CursorService;

/**
 * Get Cursor team daily usage data for a date range.
 */
class CursorGetDailyUsageData implements Tool
{
    /**
     * @param  CursorService  $service  The Cursor Admin API client.
     */
    public function __construct(private CursorService $service) {}

    public function name(): string
    {
        return 'cursor_get_daily_usage_data';
    }

    public function description(): string
    {
        return 'Get Cursor team daily usage data for a start and end date in epoch milliseconds.';
    }

    public function parameters(): array
    {
        return [
            'start_date' => ['type' => 'integer', 'description' => 'Start date as epoch milliseconds.'],
            'end_date' => ['type' => 'integer', 'description' => 'End date as epoch milliseconds.'],
        ];
    }

    /**
     * Execute the tool and return daily usage data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (start_date, end_date).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Cursor integration is not configured.');
            }

            $params = [];
            if (isset($args['start_date'])) {
                $params['startDate'] = (int) $args['start_date'];
            }
            if (isset($args['end_date'])) {
                $params['endDate'] = (int) $args['end_date'];
            }

            return ToolResult::success($this->service->getDailyUsageData($params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
