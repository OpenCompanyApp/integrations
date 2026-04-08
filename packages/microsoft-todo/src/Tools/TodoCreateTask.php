<?php

namespace OpenCompany\Integrations\MicrosoftTodo\Tools;

use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create a new task in a Microsoft To Do task list.
 *
 * Calls `POST /me/todo/lists/{id}/tasks` on the Microsoft Graph API with a
 * title, optional body content, and optional due date. Returns the created task.
 *
 * @see https://learn.microsoft.com/en-us/graph/api/todotasklist-post-tasks
 */
class TodoCreateTask implements Tool
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
        return 'todo_create_task';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new task in a Microsoft To Do task list. Provide a title, and optionally a body and due date.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the todo task list to add the task to.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the task (e.g., "Buy groceries").'],
            'body' => ['type' => 'string', 'description' => 'Optional body/content text for the task.'],
            'due_date' => ['type' => 'string', 'description' => 'Optional due date in ISO 8601 format (e.g., "2026-04-30T00:00:00").'],
            'due_timezone' => ['type' => 'string', 'description' => 'Timezone for the due date (e.g., "UTC", "Europe/Amsterdam"). Defaults to "UTC".'],
        ];
    }

    /**
     * Execute the tool — create a new task.
     *
     * @param  array<string, mixed>  $args  Tool arguments (requires 'list_id' and 'title').
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

            if (empty($args['title'])) {
                return ToolResult::error('The "title" parameter is required.');
            }

            $dueDateTime = null;
            if (!empty($args['due_date'])) {
                $dueDateTime = [
                    'dateTime' => $args['due_date'],
                    'timeZone' => $args['due_timezone'] ?? 'UTC',
                ];
            }

            $result = $this->service->createTask(
                $args['list_id'],
                $args['title'],
                $args['body'] ?? null,
                $dueDateTime,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
