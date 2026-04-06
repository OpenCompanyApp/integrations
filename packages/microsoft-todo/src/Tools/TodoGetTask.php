<?php

namespace OpenCompany\Integrations\MicrosoftTodo\Tools;

use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get a specific task from a Microsoft To Do task list.
 *
 * Calls `GET /me/todo/lists/{list_id}/tasks/{id}` on the Microsoft Graph API
 * and returns the full task resource including body, status, due date, and more.
 *
 * @see https://learn.microsoft.com/en-us/graph/api/todotask-get
 */
class TodoGetTask implements Tool
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
        return 'todo_get_task';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get a specific task from a Microsoft To Do task list by its ID. Returns full task details including title, body, status, due date, and importance.';
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
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the task.'],
        ];
    }

    /**
     * Execute the tool — fetch a single task.
     *
     * @param  array<string, mixed>  $args  Tool arguments (requires 'list_id' and 'id').
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

            if (empty($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getTask($args['list_id'], $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
