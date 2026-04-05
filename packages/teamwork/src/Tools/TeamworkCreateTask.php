<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_create_task
 *
 * Create a new task in a Teamwork project.
 */
class TeamworkCreateTask implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_create_task';
    }

    public function description(): string
    {
        return 'Create a new task in a Teamwork project. Provide the project ID and task name.';
    }

    public function parameters(): array
    {
        return [
            'project_id'    => ['type' => 'integer', 'required' => true, 'description' => 'The project ID to create the task in.'],
            'name'          => ['type' => 'string',  'required' => true, 'description' => 'Task name.'],
            'description'   => ['type' => 'string',  'description' => 'Task description (optional).'],
            'assigneeIds'   => ['type' => 'array',   'description' => 'Array of user IDs to assign the task to.'],
            'dueDate'       => ['type' => 'string',  'description' => 'Due date in ISO 8601 format (e.g., "2026-04-30").'],
            'priority'      => ['type' => 'string',  'description' => 'Task priority: "low", "medium", "high".'],
            'estimatedTime' => ['type' => 'integer', 'description' => 'Estimated time in minutes.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $projectId = (int) $args['project_id'];
            $name      = $args['name'];

            $extra = [];
            if (isset($args['description']))    $extra['description']    = $args['description'];
            if (isset($args['assigneeIds']))    $extra['assigneeIds']    = $args['assigneeIds'];
            if (isset($args['dueDate']))        $extra['dueDate']        = $args['dueDate'];
            if (isset($args['priority']))       $extra['priority']       = $args['priority'];
            if (isset($args['estimatedTime']))  $extra['estimatedTime']  = (int) $args['estimatedTime'];

            $result = $this->service->createTask($projectId, $name, $extra);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
