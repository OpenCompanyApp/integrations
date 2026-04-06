<?php

namespace OpenCompany\Integrations\Kimai\Tools;

use OpenCompany\Integrations\Kimai\KimaiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KimaiListTimesheets implements Tool
{
    public function __construct(
        private KimaiService $service,
    ) {}

    public function name(): string
    {
        return 'kimai_list_timesheets';
    }

    public function description(): string
    {
        return 'List time-tracking entries from Kimai. Supports filtering by user, project, date range, and state. Returns paginated results with timesheet details including duration, description, and associated project/activity.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50).'],
            'user' => ['type' => 'string', 'description' => 'Filter by user ID or username.'],
            'project' => ['type' => 'integer', 'description' => 'Filter by project ID.'],
            'begin' => ['type' => 'string', 'description' => 'Filter start date (ISO 8601, e.g., "2025-01-01T00:00:00"). Only entries starting on or after this date.'],
            'end' => ['type' => 'string', 'description' => 'Filter end date (ISO 8601, e.g., "2025-01-31T23:59:59"). Only entries starting before or on this date.'],
            'state' => ['type' => 'string', 'description' => 'Filter by state: "running" for active timers, "stopped" for completed entries. Omit for all.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kimai integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['size'])) {
                $params['size'] = (int) $args['size'];
            }
            if (isset($args['user'])) {
                $params['user'] = $args['user'];
            }
            if (isset($args['project'])) {
                $params['project'] = (int) $args['project'];
            }
            if (isset($args['begin'])) {
                $params['begin'] = $args['begin'];
            }
            if (isset($args['end'])) {
                $params['end'] = $args['end'];
            }
            if (isset($args['state'])) {
                $params['state'] = $args['state'];
            }

            $result = $this->service->listTimesheets($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
