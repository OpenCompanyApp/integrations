<?php

namespace OpenCompany\Integrations\MicrosoftTodo\Tools;

use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create a new Microsoft To Do task list.
 *
 * Calls `POST /me/todo/lists` on the Microsoft Graph API with a display name
 * and returns the created task list resource.
 *
 * @see https://learn.microsoft.com/en-us/graph/api/todo-post-lists
 */
class TodoCreateList implements Tool
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
        return 'todo_create_list';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new Microsoft To Do task list. Provide a display name for the list.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'displayName' => ['type' => 'string', 'required' => true, 'description' => 'The name of the new task list (e.g., "Shopping List", "Work Tasks").'],
        ];
    }

    /**
     * Execute the tool — create a new task list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (requires 'displayName').
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft To Do integration is not configured.');
            }

            if (empty($args['displayName'])) {
                return ToolResult::error('The "displayName" parameter is required.');
            }

            $result = $this->service->createList($args['displayName']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
