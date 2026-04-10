<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List projects in a Plane.so workspace.
 */
class PlaneListProjects implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_projects';
    }

    public function description(): string
    {
        return <<<'DESC'
List all projects in a Plane.so workspace.
Returns project ID, name, identifier, description, and status.
Use the project ID to reference projects in other tools.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug (e.g., "my-team").'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plane.so integration is not configured.');
            }

            $projects = $this->service->listProjects($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null));

            $results = array_map(fn(array $project) => [
                'id' => $project['id'] ?? null,
                'name' => $project['name'] ?? null,
                'identifier' => $project['identifier'] ?? null,
                'description' => $project['description'] ?? null,
                'is_active' => $project['is_active'] ?? null,
                'is_favorite' => $project['is_favorite'] ?? null,
                'created_at' => $project['created_at'] ?? null,
            ], $projects);

            return ToolResult::success([
                'projects' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
