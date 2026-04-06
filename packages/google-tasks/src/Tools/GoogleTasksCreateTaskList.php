<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

use OpenCompany\Integrations\GoogleTasks\GoogleTasksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleTasksCreateTaskList implements Tool
{
    public function __construct(
        private GoogleTasksService $service,
    ) {}

    public function name(): string
    {
        return 'gtasks_create_task_list';
    }

    public function description(): string
    {
        return 'Create a new task list in Google Tasks. Provide a title for the new list.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the new task list (e.g., "Work Projects", "Shopping List").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Tasks integration is not configured.');
            }

            if (empty($args['title'])) {
                return ToolResult::error('The "title" parameter is required.');
            }

            $result = $this->service->createTaskList($args['title']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
