<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Core\Contracts\Tool;
use OpenCompany\Integrations\Core\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * Create a new task in Todoist with specified properties.
 */
class TodoistCreateTask implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_create_task';
    }

    public function description(): string
    {
        return 'Create a new task in Todoist. Supports setting project, section, labels, priority (1=normal, 2=medium, 3=high, 4=urgent), due date, and description.';
    }

    public function parameters(): array
    {
        return [
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The task content/title.'],
            'project_id' => ['type' => 'string', 'required' => false, 'description' => 'ID of the project to add the task to.'],
            'section_id' => ['type' => 'string', 'required' => false, 'description' => 'ID of the section to add the task to.'],
            'labels' => ['type' => 'array', 'required' => false, 'description' => 'List of label names to assign.', 'items' => ['type' => 'string']],
            'priority' => ['type' => 'integer', 'required' => false, 'description' => 'Task priority: 1=normal, 2=medium, 3=high, 4=urgent.'],
            'due_date' => ['type' => 'string', 'required' => false, 'description' => 'Due date in YYYY-MM-DD format.'],
            'due_string' => ['type' => 'string', 'required' => false, 'description' => 'Due date in natural language (e.g., "tomorrow", "every Monday").'],
            'description' => ['type' => 'string', 'required' => false, 'description' => 'Detailed description for the task.'],
        ];
    }

    /**
     * Create a new task in Todoist.
     *
     * @param array<string, mixed> $args Task properties to create.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $result = $this->service->createTask($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
