<?php

namespace OpenCompany\Integrations\MicrosoftTodo\Tools;

use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List all tasks in a Microsoft To Do task list.
 *
 * Calls `GET /me/todo/lists/{id}/tasks` on the Microsoft Graph API and returns
 * every task in the specified list with its status, title, body, and due date.
 *
 * @see https://learn.microsoft.com/en-us/graph/api/todotasklist-list-tasks
 */
class TodoListTasks implements Tool
{
    /**
     * @param  MicrosoftTodoService  $service  The Microsoft To Do API service.
     */
    public function __construct(
        private MicrosoftTodoService $service,
    ) {}

    /**
     * The machine name of this tool.
     */
    public function name(): string
    {
        return 'todo_list_tasks';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all tasks in a Microsoft To Do task list. Returns task titles, statuses, body content, and due dates.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the todo task list.'],
        ];
    }

    /**
     * Execute the tool — fetch all tasks in a list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (requires 'list_id').
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft To Do integration is not configured.');
            }

            if (empty($args['list_id'])) {
                return ToolResult::error('The "list_id" parameter is required.');
            }

            $result = $this->service->listTasks($args['list_id']);

            $tasks = $result['value'] ?? [];

            return ToolResult::success([
                'tasks' => array_map(function (array $task): array {
                    return [
                        'id' => $task['id'] ?? null,
                        'title' => $task['title'] ?? null,
                        'status' => $task['status'] ?? null,
                        'body' => $task['body'] ?? null,
                        'dueDateTime' => $task['dueDateTime'] ?? null,
                        'importance' => $task['importance'] ?? null,
                        'isReminderOn' => $task['isReminderOn'] ?? false,
                        'createdDateTime' => $task['createdDateTime'] ?? null,
                        'lastModifiedDateTime' => $task['lastModifiedDateTime'] ?? null,
                    ];
                }, $tasks),
                'count' => count($tasks),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
