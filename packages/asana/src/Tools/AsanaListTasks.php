<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List tasks in Asana with optional filters.
 */
class AsanaListTasks implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks in Asana with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'project'         => ['type' => 'string',  'description' => 'Project GID to filter tasks by.'],
            'assignee'        => ['type' => 'string',  'description' => 'User GID to filter by assignee, or "me".'],
            'workspace'       => ['type' => 'string',  'description' => 'Workspace GID to filter tasks by.'],
            'completed_since' => ['type' => 'string',  'description' => 'Only return tasks completed after this ISO 8601 date.'],
            'limit'           => ['type' => 'integer', 'description' => 'Max number of tasks to return (1–100).'],
            'offset'          => ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
        ];
    }

    /**
     * Retrieve a list of tasks with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project, assignee, workspace, completed_since, limit, offset)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $params = [];

            if (isset($args['project'])) {
                $params['project'] = $args['project'];
            }
            if (isset($args['assignee'])) {
                $params['assignee'] = $args['assignee'];
            }
            if (isset($args['workspace'])) {
                $params['workspace'] = $args['workspace'];
            }
            if (isset($args['completed_since'])) {
                $params['completed_since'] = $args['completed_since'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = $args['offset'];
            }

            $tasks = $this->service->listTasks($params);

            return ToolResult::success($tasks);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
