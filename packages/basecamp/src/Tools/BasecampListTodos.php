<?php

namespace OpenCompany\Integrations\Basecamp\Tools;

use OpenCompany\Integrations\Basecamp\BasecampService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: basecamp_list_todos
 *
 * Lists to-dos in a specific Basecamp to-do list.
 * Requires the project ID, to-do set ID, and to-do list ID to locate
 * the correct list within the Basecamp project hierarchy.
 *
 * @see https://github.com/basecamp/api/blob/master/sections/todos.md#list-to-dos
 */
class BasecampListTodos implements Tool
{
    /**
     * @param  BasecampService  $service  The Basecamp API service instance.
     */
    public function __construct(
        private BasecampService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'basecamp_list_todos';
    }

    /**
     * Human-readable description shown to AI agents.
     */
    public function description(): string
    {
        return 'List to-dos in a Basecamp to-do list. Requires the project ID, to-do set ID, and to-do list ID. Returns to-do items with their content, completion status, assignees, and due dates.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Basecamp project ID.'],
            'todoset_id' => ['type' => 'integer', 'required' => true, 'description' => 'The to-do set (bucket) ID within the project. Typically found in the project\'s "todolists" tool.'],
            'todolist_id' => ['type' => 'integer', 'required' => true, 'description' => 'The specific to-do list ID to retrieve to-dos from.'],
        ];
    }

    /**
     * Execute the tool — fetch to-dos from a Basecamp to-do list.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Basecamp integration is not configured.');
            }

            $projectId = (int) ($args['project_id'] ?? 0);
            $todosetId = (int) ($args['todoset_id'] ?? 0);
            $todolistId = (int) ($args['todolist_id'] ?? 0);

            if ($projectId <= 0) {
                return ToolResult::error('A valid project_id is required.');
            }

            if ($todosetId <= 0) {
                return ToolResult::error('A valid todoset_id is required.');
            }

            if ($todolistId <= 0) {
                return ToolResult::error('A valid todolist_id is required.');
            }

            $result = $this->service->listTodos($projectId, $todosetId, $todolistId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
