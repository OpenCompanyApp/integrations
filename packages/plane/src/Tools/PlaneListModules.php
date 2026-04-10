<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List modules in a Plane.so project.
 */
class PlaneListModules implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_modules';
    }

    public function description(): string
    {
        return <<<'DESC'
List all modules in a Plane.so project. Modules group related issues together (e.g., "Auth System", "Payment Integration").
Returns module ID, name, description, status, and dates.
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

            $modules = $this->service->listModules($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id']);

            $results = array_map(fn(array $module) => [
                'id' => $module['id'] ?? null,
                'name' => $module['name'] ?? null,
                'description' => $module['description'] ?? null,
                'status' => $module['status'] ?? null,
                'start_date' => $module['start_date'] ?? null,
                'target_date' => $module['target_date'] ?? null,
                'is_favorite' => $module['is_favorite'] ?? null,
                'created_at' => $module['created_at'] ?? null,
            ], $modules);

            return ToolResult::success([
                'modules' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
