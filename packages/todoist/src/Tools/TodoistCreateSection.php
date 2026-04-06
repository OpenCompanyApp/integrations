<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * Create a new section within a Todoist project.
 */
class TodoistCreateSection implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_create_section';
    }

    public function description(): string
    {
        return 'Create a new section within a Todoist project to organize tasks into groups.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the section.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the project to create the section in.'],
            'order' => ['type' => 'integer', 'required' => false, 'description' => 'Position of the section within the project (1-based).'],
        ];
    }

    /**
     * Create a new section in a Todoist project.
     *
     * @param array<string, mixed> $args Must contain 'name' and 'project_id'.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $result = $this->service->createSection($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
