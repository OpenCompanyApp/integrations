<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * Create a new project in Todoist.
 */
class TodoistCreateProject implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_create_project';
    }

    public function description(): string
    {
        return 'Create a new project in Todoist. Projects can be nested using parent_id.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the project.'],
            'parent_id' => ['type' => 'string', 'required' => false, 'description' => 'ID of the parent project for nesting.'],
            'color' => ['type' => 'string', 'required' => false, 'description' => 'Color ID or name for the project.'],
            'is_favorite' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to mark the project as favorite.'],
            'view_style' => ['type' => 'string', 'required' => false, 'description' => 'View style: "list" or "board".', 'enum' => ['list', 'board']],
        ];
    }

    /**
     * Create a new Todoist project.
     *
     * @param array<string, mixed> $args Project properties; 'name' is required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $result = $this->service->createProject($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
