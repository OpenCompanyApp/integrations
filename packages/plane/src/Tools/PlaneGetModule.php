<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a Plane.so module.
 */
class PlaneGetModule implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_get_module';
    }

    public function description(): string
    {
        return <<<'DESC'
Get detailed information about a Plane.so module, including name, description, status, dates, and team.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'module_id' => ['type' => 'string', 'required' => true, 'description' => 'The module UUID.'],
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

            $module = $this->service->getModule(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['module_id'],
            );

            return ToolResult::success([
                'id' => $module['id'] ?? null,
                'name' => $module['name'] ?? null,
                'description' => $module['description'] ?? null,
                'status' => $module['status'] ?? null,
                'start_date' => $module['start_date'] ?? null,
                'target_date' => $module['target_date'] ?? null,
                'lead' => $module['lead'] ?? null,
                'members' => $module['members'] ?? [],
                'is_favorite' => $module['is_favorite'] ?? null,
                'created_at' => $module['created_at'] ?? null,
                'updated_at' => $module['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
