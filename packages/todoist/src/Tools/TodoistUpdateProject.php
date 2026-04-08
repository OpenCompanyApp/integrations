<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * Update an existing Todoist project's properties.
 */
class TodoistUpdateProject implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_update_project';
    }

    public function description(): string
    {
        return 'Update an existing project in Todoist. Only the fields provided will be changed.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the project to update.'],
            'name' => ['type' => 'string', 'required' => false, 'description' => 'New name for the project.'],
            'color' => ['type' => 'string', 'required' => false, 'description' => 'New color ID or name.'],
            'is_favorite' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether the project is a favorite.'],
            'view_style' => ['type' => 'string', 'required' => false, 'description' => 'View style: "list" or "board".', 'enum' => ['list', 'board']],
        ];
    }

    /**
     * Update an existing Todoist project.
     *
     * @param array<string, mixed> $args Must contain 'id'; other fields are optional updates.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $id = $args['id'];
            unset($args['id']);

            $result = $this->service->updateProject($id, $args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
