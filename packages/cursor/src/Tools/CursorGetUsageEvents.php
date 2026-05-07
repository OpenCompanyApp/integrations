<?php

namespace OpenCompany\Integrations\Cursor\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cursor\CursorService;

/**
 * Get detailed Cursor usage events with filters and pagination.
 */
class CursorGetUsageEvents implements Tool
{
    /**
     * @param  CursorService  $service  The Cursor Admin API client.
     */
    public function __construct(private CursorService $service) {}

    public function name(): string
    {
        return 'cursor_get_usage_events';
    }

    public function description(): string
    {
        return 'Get detailed Cursor usage events filtered by date range, user ID, email, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'start_date' => ['type' => 'integer', 'description' => 'Start date as epoch milliseconds.'],
            'end_date' => ['type' => 'integer', 'description' => 'End date as epoch milliseconds.'],
            'user_id' => ['type' => 'integer', 'description' => 'Cursor user ID.'],
            'email' => ['type' => 'string', 'description' => 'Team member email address.'],
            'page' => ['type' => 'integer', 'description' => 'Page number, 1-indexed.'],
            'page_size' => ['type' => 'integer', 'description' => 'Results per page.'],
        ];
    }

    /**
     * Execute the tool and return usage events.
     *
     * @param  array<string, mixed>  $args  Tool arguments (start_date, end_date, user_id, email, page, page_size).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Cursor integration is not configured.');
            }

            $mapping = [
                'start_date' => 'startDate',
                'end_date' => 'endDate',
                'user_id' => 'userId',
                'email' => 'email',
                'page' => 'page',
                'page_size' => 'pageSize',
            ];

            $params = [];
            foreach ($mapping as $arg => $api) {
                if (isset($args[$arg])) {
                    $params[$api] = in_array($arg, ['start_date', 'end_date', 'user_id', 'page', 'page_size'], true) ? (int) $args[$arg] : $args[$arg];
                }
            }

            return ToolResult::success($this->service->getUsageEvents($params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
