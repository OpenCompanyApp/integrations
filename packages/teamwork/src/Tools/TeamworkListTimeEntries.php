<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_list_time_entries
 *
 * List time entries for a Teamwork project.
 */
class TeamworkListTimeEntries implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_list_time_entries';
    }

    public function description(): string
    {
        return 'List time entries logged against a Teamwork project. Returns hours, descriptions, dates, and who logged them.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
            'page'       => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'pageSize'   => ['type' => 'integer', 'description' => 'Number of results per page (default: 50).'],
            'fromDate'   => ['type' => 'string',  'description' => 'Filter from date (ISO 8601, e.g., "2026-01-01").'],
            'toDate'     => ['type' => 'string',  'description' => 'Filter to date (ISO 8601, e.g., "2026-04-30").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $projectId = (int) $args['project_id'];
            $params = [];
            if (isset($args['page']))     $params['page']     = (int) $args['page'];
            if (isset($args['pageSize'])) $params['pageSize'] = (int) $args['pageSize'];
            if (isset($args['fromDate'])) $params['fromDate'] = $args['fromDate'];
            if (isset($args['toDate']))   $params['toDate']   = $args['toDate'];

            $result = $this->service->listTimeEntries($projectId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
