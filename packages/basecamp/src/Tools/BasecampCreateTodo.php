<?php

namespace OpenCompany\Integrations\Basecamp\Tools;

use OpenCompany\Integrations\Basecamp\BasecampService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: basecamp_create_todo
 *
 * Creates a new to-do item in a Basecamp to-do list.
 * Requires the project ID, to-do set ID, and to-do list ID to locate
 * the correct list within the Basecamp project hierarchy.
 *
 * @see https://github.com/basecamp/api/blob/master/sections/todos.md#create-a-to-do
 */
class BasecampCreateTodo implements Tool
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
        return 'basecamp_create_todo';
    }

    /**
     * Human-readable description shown to AI agents.
     */
    public function description(): string
    {
        return 'Create a new to-do in a Basecamp to-do list. Specify the project, to-do set, to-do list, and to-do text. Optionally include a description, due date, and assignee IDs.';
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
            'todoset_id' => ['type' => 'integer', 'required' => true, 'description' => 'The to-do set (bucket) ID within the project.'],
            'todolist_id' => ['type' => 'integer', 'required' => true, 'description' => 'The specific to-do list ID to add the to-do to.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The to-do text (e.g., "Review pull request").'],
            'description' => ['type' => 'string', 'description' => 'Extended description for the to-do. Supports HTML formatting.'],
            'due_on' => ['type' => 'string', 'description' => 'Due date in ISO 8601 format (e.g., "2026-04-30").'],
            'assignee_ids' => ['type' => 'array', 'description' => 'List of person IDs to assign (e.g., [1234, 5678]).'],
        ];
    }

    /**
     * Execute the tool — create a to-do in Basecamp.
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

            $content = $args['content'] ?? '';

            if (empty($content)) {
                return ToolResult::error('The content (to-do text) is required.');
            }

            $description = $args['description'] ?? '';
            $dueOn = $args['due_on'] ?? null;
            $assigneeIds = isset($args['assignee_ids']) && is_array($args['assignee_ids'])
                ? array_map('intval', $args['assignee_ids'])
                : null;

            $result = $this->service->createTodo(
                $projectId,
                $todosetId,
                $todolistId,
                $content,
                $description,
                $dueOn,
                $assigneeIds,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
