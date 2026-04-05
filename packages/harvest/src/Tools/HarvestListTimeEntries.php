<?php

namespace OpenCompany\Integrations\Harvest\Tools;

use OpenCompany\Integrations\Harvest\HarvestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Harvest time entries with optional filters.
 *
 * Supports filtering by user, client, project, billing status,
 * running status, and date range. Paginated via page/per_page.
 */
class HarvestListTimeEntries implements Tool
{
    /**
     * @param  HarvestService  $service  The Harvest API client
     */
    public function __construct(
        private HarvestService $service,
    ) {}

    public function name(): string
    {
        return 'harvest_list_time_entries';
    }

    public function description(): string
    {
        return 'List Harvest time entries with optional filters for user, client, project, and date range.';
    }

    public function parameters(): array
    {
        return [
            'user_id'    => ['type' => 'integer', 'description' => 'Filter by user ID.'],
            'client_id'  => ['type' => 'integer', 'description' => 'Filter by client ID.'],
            'project_id' => ['type' => 'integer', 'description' => 'Filter by project ID.'],
            'is_billed'  => ['type' => 'boolean', 'description' => 'Filter by billed status (true/false).'],
            'is_running' => ['type' => 'boolean', 'description' => 'Filter to only running timers.'],
            'from'       => ['type' => 'string',  'description' => 'Start date filter (YYYY-MM-DD).'],
            'to'         => ['type' => 'string',  'description' => 'End date filter (YYYY-MM-DD).'],
            'page'       => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'per_page'   => ['type' => 'integer', 'description' => 'Results per page (default: 100, max: 2000).'],
        ];
    }

    /**
     * List time entries with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id, client_id, project_id, is_billed, is_running, from, to, page, per_page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Harvest integration is not configured.');
            }

            $params = [];

            foreach (['user_id', 'client_id', 'project_id', 'is_billed', 'is_running', 'from', 'to', 'page', 'per_page'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listTimeEntries($params);

            return ToolResult::success([
                'time_entries' => $result['time_entries'] ?? [],
                'pagination'   => $result['_pagination'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
