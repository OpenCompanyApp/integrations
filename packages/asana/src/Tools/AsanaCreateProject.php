<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new project in Asana.
 */
class AsanaCreateProject implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_create_project';
    }

    public function description(): string
    {
        return 'Create a new project in Asana.';
    }

    public function parameters(): array
    {
        return [
            'name'      => ['type' => 'string', 'required' => true,  'description' => 'Name of the project.'],
            'notes'     => ['type' => 'string', 'description' => 'Free-form description of the project.'],
            'workspace' => ['type' => 'string', 'required' => true,  'description' => 'Workspace GID where the project will be created.'],
            'team'      => ['type' => 'string', 'description' => 'Team GID to add the project to.'],
            'color'     => ['type' => 'string', 'description' => 'Color for the project (e.g. "dark-pink", "dark-green").'],
        ];
    }

    /**
     * Create a new project with the given details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, notes, workspace, team, color)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $name = $args['name'] ?? '';
            $workspace = $args['workspace'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }
            if (empty($workspace)) {
                return ToolResult::error('workspace is required.');
            }

            $data = [
                'name' => $name,
                'workspace' => $workspace,
            ];

            if (isset($args['notes'])) {
                $data['notes'] = $args['notes'];
            }
            if (isset($args['team'])) {
                $data['team'] = $args['team'];
            }
            if (isset($args['color'])) {
                $data['color'] = $args['color'];
            }

            $project = $this->service->createProject($data);

            return ToolResult::success($project);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
