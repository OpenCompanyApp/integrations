<?php

namespace OpenCompany\Integrations\MicrosoftTodo\Tools;

use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List all Microsoft To Do task lists.
 *
 * Calls `GET /me/todo/lists` on the Microsoft Graph API and returns every
 * task list owned by the authenticated user, including the default list.
 *
 * @see https://learn.microsoft.com/en-us/graph/api/todo-list-lists
 */
class TodoListLists implements Tool
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
        return 'todo_list_lists';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all Microsoft To Do task lists for the authenticated user. Returns the list ID, display name, and well-known name for each list.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — fetch all task lists.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft To Do integration is not configured.');
            }

            $result = $this->service->listLists();

            $lists = $result['value'] ?? [];

            return ToolResult::success([
                'lists' => array_map(function (array $list): array {
                    return [
                        'id' => $list['id'] ?? null,
                        'displayName' => $list['displayName'] ?? null,
                        'wellknownListName' => $list['wellknownListName'] ?? null,
                        'isOwner' => $list['isOwner'] ?? true,
                        'isShared' => $list['isShared'] ?? false,
                    ];
                }, $lists),
                'count' => count($lists),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
