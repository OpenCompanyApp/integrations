<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Todoist\TodoistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TodoistCreateTask implements Tool
{
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string { return 'todoist_create_task'; }
    public function description(): string { return 'Create a new task in Todoist.'; }

    public function parameters(): array
    {
        return [
            'content'    => ['type' => 'string', 'required' => true,  'description' => 'Text content of the task.'],
            'description'=> ['type' => 'string', 'description' => 'Detailed description of the task (supports Markdown).'],
            'project_id' => ['type' => 'string', 'description' => 'Project ID to add the task to.'],
            'section_id' => ['type' => 'string', 'description' => 'Section ID to add the task to.'],
            'parent_id'  => ['type' => 'string', 'description' => 'Parent task ID for creating a subtask.'],
            'order'      => ['type' => 'integer','description' => 'Position among siblings or in the project.'],
            'priority'   => ['type' => 'integer','description' => 'Priority level (1=normal, 2=medium, 3=high, 4=urgent).'],
            'labels'     => ['type' => 'array',  'description' => 'Array of label names to assign.'],
            'due_string' => ['type' => 'string', 'description' => 'Human-readable due date (e.g. "every first Monday", "tomorrow").'],
            'due_date'   => ['type' => 'string', 'description' => 'Due date in YYYY-MM-DD format.'],
            'due_lang'   => ['type' => 'string', 'description' => 'Language for due_string parsing (e.g. "en").'],
            'assignee_id'=> ['type' => 'string', 'description' => 'User ID to assign the task to.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }
            $content = $args['content'] ?? '';
            if (empty($content)) {
                return ToolResult::error('content is required.');
            }
            $data = ['content' => $content];
            if (isset($args['description'])) { $data['description'] = $args['description']; }
            if (isset($args['project_id']))  { $data['project_id'] = $args['project_id']; }
            if (isset($args['section_id']))  { $data['section_id'] = $args['section_id']; }
            if (isset($args['parent_id']))   { $data['parent_id'] = $args['parent_id']; }
            if (isset($args['order']))       { $data['order'] = (int) $args['order']; }
            if (isset($args['priority']))    { $data['priority'] = (int) $args['priority']; }
            if (isset($args['labels']))      { $data['labels'] = $args['labels']; }
            if (isset($args['due_string']))  { $data['due_string'] = $args['due_string']; }
            if (isset($args['due_date']))    { $data['due_date'] = $args['due_date']; }
            if (isset($args['due_lang']))    { $data['due_lang'] = $args['due_lang']; }
            if (isset($args['assignee_id'])) { $data['assignee_id'] = $args['assignee_id']; }
            $task = $this->service->createTask($data);
            return ToolResult::success($task);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
