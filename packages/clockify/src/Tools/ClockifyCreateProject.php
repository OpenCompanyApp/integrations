<?php

namespace OpenCompany\Integrations\Clockify\Tools;

use OpenCompany\Integrations\Clockify\ClockifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clockify_create_project
 *
 * Creates a new project in a Clockify workspace.
 */
class ClockifyCreateProject implements Tool
{
    public function __construct(
        private ClockifyService $service,
    ) {}

    public function name(): string
    {
        return 'clockify_create_project';
    }

    public function description(): string
    {
        return 'Create a new project in a Clockify workspace.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'name'         => ['type' => 'string', 'required' => true, 'description' => 'Project name.'],
            'color'        => ['type' => 'string', 'description' => 'Hex color code (e.g. "#ff0000"). Defaults to "#03a9f4".'],
            'is_public'    => ['type' => 'boolean', 'description' => 'Whether the project is publicly visible. Defaults to false.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clockify integration is not configured.');
            }

            $result = $this->service->createProject(
                workspaceId: $args['workspace_id'],
                name: $args['name'],
                color: $args['color'] ?? '#03a9f4',
                isPublic: $args['is_public'] ?? false,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
