<?php

namespace OpenCompany\Integrations\Hubstaff\Tools;

use OpenCompany\Integrations\Hubstaff\HubstaffService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HubstaffListTimeEntries implements Tool
{
    public function __construct(
        private HubstaffService $service,
    ) {}

    public function name(): string
    {
        return 'hubstaff_list_time_entries';
    }

    public function description(): string
    {
        return 'List time entries from Hubstaff. Supports filtering by date range, user IDs, and project ID. Returns tracked time entries with duration, notes, and associated project/user information.';
    }

    public function parameters(): array
    {
        return [
            'startTime' => ['type' => 'string', 'description' => 'Start of the date range (ISO 8601, e.g., "2026-04-01T00:00:00Z"). Required for most queries.'],
            'endTime' => ['type' => 'string', 'description' => 'End of the date range (ISO 8601, e.g., "2026-04-06T23:59:59Z"). Required for most queries.'],
            'userIds' => ['type' => 'string', 'description' => 'Comma-separated user IDs to filter by (e.g., "123,456").'],
            'projectId' => ['type' => 'integer', 'description' => 'Project ID to filter time entries by.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of time entries to return per page (default: 50, max: 500).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hubstaff integration is not configured.');
            }

            $params = [];

            if (isset($args['startTime'])) {
                $params['startTime'] = $args['startTime'];
            }
            if (isset($args['endTime'])) {
                $params['endTime'] = $args['endTime'];
            }
            if (isset($args['userIds'])) {
                $params['userIds'] = $args['userIds'];
            }
            if (isset($args['projectId'])) {
                $params['projectId'] = (int) $args['projectId'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listTimeEntries($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
