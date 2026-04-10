<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List states (workflow statuses) in a Plane.so project.
 */
class PlaneListStates implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_states';
    }

    public function description(): string
    {
        return <<<'DESC'
List all workflow states in a Plane.so project. Returns state UUID, name, group (backlog/unstarted/started/completed/cancelled), and color.
Use state UUIDs when creating or updating issues.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
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

            $states = $this->service->listStates($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id']);

            $results = array_map(fn(array $state) => [
                'id' => $state['id'] ?? null,
                'name' => $state['name'] ?? null,
                'group' => $state['group'] ?? null,
                'color' => $state['color'] ?? null,
                'slug' => $state['slug'] ?? null,
                'description' => $state['description'] ?? null,
                'is_default' => $state['default'] ?? false,
            ], $states);

            return ToolResult::success([
                'states' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
