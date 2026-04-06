<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * List Todoist tasks with optional filtering by project, section, label, or filter expression.
 */
class TodoistListTasks implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks from Todoist with optional filters for project, section, label, or Todoist filter expressions.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => false, 'description' => 'Filter tasks by project ID.'],
            'section_id' => ['type' => 'string', 'required' => false, 'description' => 'Filter tasks by section ID.'],
            'label' => ['type' => 'string', 'required' => false, 'description' => 'Filter by label name.'],
            'filter' => ['type' => 'string', 'required' => false, 'description' => 'Todoist filter expression (e.g., "today", "p1 & @Work").'],
            'lang' => ['type' => 'string', 'required' => false, 'description' => 'Language for the filter expression (e.g., "en", "de").'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of tasks to return (default: all).'],
            'ids' => ['type' => 'array', 'required' => false, 'description' => 'List of specific task IDs to retrieve.', 'items' => ['type' => 'string']],
        ];
    }

    /**
     * List Todoist tasks with the given filters applied.
     *
     * @param array<string, mixed> $args Optional filter parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $result = $this->service->listTasks($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
