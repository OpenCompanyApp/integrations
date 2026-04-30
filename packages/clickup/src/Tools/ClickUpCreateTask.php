<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpCreateTask implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_create_task';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new task in a ClickUp list.
        Requires a list ID and task name. Supports description, status,
        priority, assignees, dates, tags, and creating subtasks via parentTaskId.
        Use clickup_get_hierarchy to find list IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List ID to create the task in.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Task name.'],
            'description' => ['type' => 'string', 'description' => 'Task description text.'],
            'status' => ['type' => 'string', 'description' => 'Task status (must be valid for the list).'],
            'priority' => ['type' => 'integer', 'description' => 'Priority: 1=urgent, 2=high, 3=normal, 4=low.'],
            'assignees' => ['type' => 'string', 'description' => 'Comma-separated user IDs to assign. Use clickup_resolve_members to resolve names to IDs.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date in ISO 8601 format (e.g., "2026-03-15" or "2026-03-15T14:30:00").'],
            'start_date' => ['type' => 'string', 'description' => 'Start date in ISO 8601 format.'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated tag names. Tags must exist in the space.'],
            'parent_task_id' => ['type' => 'string', 'description' => 'Parent task ID to create this as a subtask.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $listId = $args['list_id'] ?? '';
            $name = $args['name'] ?? '';

            if (empty($listId)) {
                return ToolResult::error('list_id is required.');
            }
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }
            if (isset($args['priority'])) {
                // ClickUp priority: 1=urgent, 2=high, 3=normal, 4=low
                $data['priority'] = (int) $args['priority'];
            }
            if (isset($args['assignees'])) {
                $assignees = is_string($args['assignees']) ? explode(',', $args['assignees']) : $args['assignees'];
                $data['assignees'] = array_map('intval', array_map('trim', $assignees));
            }
            if (isset($args['due_date'])) {
                $data['due_date'] = ClickUpService::toMillis($args['due_date']);
                $data['due_date_time'] = true;
            }
            if (isset($args['start_date'])) {
                $data['start_date'] = ClickUpService::toMillis($args['start_date']);
                $data['start_date_time'] = true;
            }
            if (isset($args['tags'])) {
                $tags = is_string($args['tags']) ? explode(',', $args['tags']) : $args['tags'];
                $data['tags'] = array_map('trim', $tags);
            }
            if (isset($args['parent_task_id'])) {
                $data['parent'] = $args['parent_task_id'];
            }

            $result = $this->service->createTask($listId, $data);

            return ToolResult::success([
                'id' => $result['id'],
                'name' => $result['name'],
                'status' => $result['status']['status'] ?? '',
                'url' => $result['url'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
