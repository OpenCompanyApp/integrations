<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new task in Teamwork.
 */
class TeamworkCreateTask implements Tool
{
    /**
     * @param  TeamworkService  $service  The Teamwork API client
     */
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_create_task';
    }

    public function description(): string
    {
        return 'Create a new task in Teamwork.';
    }

    public function parameters(): array
    {
        return [
            'projectId'   => ['type' => 'integer', 'required' => true,  'description' => 'The project ID to create the task in.'],
            'name'        => ['type' => 'string',  'required' => true,  'description' => 'Name of the task.'],
            'description' => ['type' => 'string',  'description' => 'Detailed description of the task.'],
            'assigneeId'  => ['type' => 'integer', 'description' => 'User ID to assign the task to.'],
            'dueDate'     => ['type' => 'string',  'description' => 'Due date in YYYYMMDD format.'],
            'priority'    => ['type' => 'string',  'description' => 'Task priority (e.g. "low", "medium", "high").'],
            'startDate'   => ['type' => 'string',  'description' => 'Start date in YYYYMMDD format.'],
        ];
    }

    /**
     * Create a new task with the given details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (projectId, name, description, assigneeId, dueDate, priority, startDate)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $projectId = $args['projectId'] ?? '';
            $name = $args['name'] ?? '';

            if (empty($projectId)) {
                return ToolResult::error('projectId is required.');
            }
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['assigneeId'])) {
                $data['responsible-party-id'] = (int) $args['assigneeId'];
            }
            if (isset($args['dueDate'])) {
                $data['due-date'] = $args['dueDate'];
            }
            if (isset($args['priority'])) {
                $data['priority'] = $args['priority'];
            }
            if (isset($args['startDate'])) {
                $data['start-date'] = $args['startDate'];
            }

            $task = $this->service->createTask(array_merge($data, ['projectId' => (int) $projectId]));

            return ToolResult::success($task);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
