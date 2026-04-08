<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new project in a Toggl Track workspace.
 *
 * Accepts project name and optional settings like color, billable flag,
 * and estimated hours. Returns the created project object.
 *
 * @see https://engineering.toggl.com/docs/api/projects#post-project
 */
class TogglCreateProject implements Tool
{
    public function __construct(
        private TogglService $service,
    ) {}

    public function name(): string
    {
        return 'toggl_create_project';
    }

    public function description(): string
    {
        return 'Create a new project in a Toggl Track workspace.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'integer', 'required' => true, 'description' => 'The workspace ID.'],
            'name'         => ['type' => 'string', 'required' => true, 'description' => 'Project name (e.g., "Website Redesign").'],
            'color'        => ['type' => 'string', 'description' => 'Project color as a hex code (e.g., "#0b83d9").'],
            'billable'     => ['type' => 'boolean', 'description' => 'Whether the project is billable. Defaults to false.'],
            'is_private'   => ['type' => 'boolean', 'description' => 'Whether the project is private. Defaults to false.'],
            'active'       => ['type' => 'boolean', 'description' => 'Whether the project is active. Defaults to true.'],
            'estimated_hours' => ['type' => 'number', 'description' => 'Estimated hours for the project.'],
            'client_id'    => ['type' => 'integer', 'description' => 'Client ID to associate with the project.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $workspaceId = (int) ($args['workspace_id'] ?? 0);

            if ($workspaceId === 0) {
                return ToolResult::error('workspace_id is required.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $args['name']];

            $optionalFields = ['color', 'billable', 'is_private', 'active', 'estimated_hours', 'client_id'];
            foreach ($optionalFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            $project = $this->service->createProject($workspaceId, $data);

            return ToolResult::success($project);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
