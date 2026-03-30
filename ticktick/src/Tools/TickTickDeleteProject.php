<?php

namespace OpenCompany\Integrations\TickTick\Tools;

use OpenCompany\Integrations\TickTick\TickTickService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TickTickDeleteProject implements Tool
{
    public function __construct(
        private TickTickService $service,
    ) {}

    public function name(): string
    {
        return 'ticktick_delete_project';
    }

    public function description(): string
    {
        return 'Delete a TickTick project and all its tasks. This action cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID to delete. Use ticktick_list_projects to find project IDs.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('TickTick integration is not configured.');
            }

            $this->service->deleteProject($args['project_id']);

            return ToolResult::success("Project '{$args['project_id']}' deleted successfully.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
