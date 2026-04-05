<?php

namespace OpenCompany\Integrations\TickTick\Tools;

use OpenCompany\Integrations\TickTick\TickTickService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TickTickGetTasks implements Tool
{
    public function __construct(
        private TickTickService $service,
    ) {}

    public function name(): string
    {
        return 'ticktick_get_tasks';
    }

    public function description(): string
    {
        return 'Get all tasks in a TickTick project. Returns task titles, IDs, priorities, due dates, and subtasks.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID to get tasks from. Use ticktick_list_projects to find project IDs.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('TickTick integration is not configured.');
            }

            $projectData = $this->service->getProjectWithData($args['project_id']);
            $tasks = $projectData['tasks'] ?? [];

            if (empty($tasks)) {
                return ToolResult::success('No tasks found in this project.');
            }

            return ToolResult::success($tasks);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
