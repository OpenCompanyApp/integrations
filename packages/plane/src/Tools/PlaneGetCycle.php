<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a Plane.so cycle including dates and progress.
 */
class PlaneGetCycle implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_get_cycle';
    }

    public function description(): string
    {
        return <<<'DESC'
Get detailed information about a Plane.so cycle, including name, description, start/end dates, and status.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'cycle_id' => ['type' => 'string', 'required' => true, 'description' => 'The cycle UUID.'],
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

            $cycle = $this->service->getCycle(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['cycle_id'],
            );

            return ToolResult::success([
                'id' => $cycle['id'] ?? null,
                'name' => $cycle['name'] ?? null,
                'description' => $cycle['description'] ?? null,
                'start_date' => $cycle['start_date'] ?? null,
                'end_date' => $cycle['end_date'] ?? null,
                'is_active' => $cycle['is_active'] ?? null,
                'is_favorite' => $cycle['is_favorite'] ?? null,
                'created_at' => $cycle['created_at'] ?? null,
                'updated_at' => $cycle['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
