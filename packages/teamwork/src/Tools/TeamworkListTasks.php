<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_list_tasks
 *
 * List tasks for a Teamwork project.
 */
class TeamworkListTasks implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks in a Teamwork project. Returns task names, statuses, assignees, and due dates.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
            'page'       => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'pageSize'   => ['type' => 'integer', 'description' => 'Number of results per page (default: 50).'],
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

            $result = $this->service->listTasks($projectId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
