<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List tasks in Teamwork with optional filters.
 */
class TeamworkListTasks implements Tool
{
    /**
     * @param  TeamworkService  $service  The Teamwork API client
     */
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks in Teamwork with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'projectId' => ['type' => 'integer', 'description' => 'Project ID to filter tasks by.'],
            'page'      => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'pageSize'  => ['type' => 'integer', 'description' => 'Number of tasks per page (max 500).'],
            'filter'    => ['type' => 'string',  'description' => 'Filter tasks (e.g. "all", "overdue", "today").'],
            'sort'      => ['type' => 'string',  'description' => 'Sort order (e.g. "duedate", "priority").'],
        ];
    }

    /**
     * Retrieve a list of tasks with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (projectId, page, pageSize, filter, sort)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $params = [];

            if (isset($args['projectId'])) {
                $params['projectId'] = (int) $args['projectId'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['pageSize'])) {
                $params['pageSize'] = (int) $args['pageSize'];
            }
            if (isset($args['filter'])) {
                $params['filter'] = $args['filter'];
            }
            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }

            $tasks = $this->service->listTasks($params);

            return ToolResult::success($tasks);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
