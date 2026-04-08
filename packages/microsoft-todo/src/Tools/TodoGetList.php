<?php

namespace OpenCompany\Integrations\MicrosoftTodo\Tools;

use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get a specific Microsoft To Do task list by ID.
 *
 * Calls `GET /me/todo/lists/{id}` on the Microsoft Graph API and returns
 * the full task list resource.
 *
 * @see https://learn.microsoft.com/en-us/graph/api/todotasklist-get
 */
class TodoGetList implements Tool
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
        return 'todo_get_list';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get a specific Microsoft To Do task list by its ID. Returns the list details including display name and well-known name.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the todo task list.'],
        ];
    }

    /**
     * Execute the tool — fetch a single task list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (requires 'id').
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft To Do integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getList($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
