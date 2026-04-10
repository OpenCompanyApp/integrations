<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List cycles in a Plane.so project.
 */
class PlaneListCycles implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_cycles';
    }

    public function description(): string
    {
        return <<<'DESC'
List all cycles in a Plane.so project. Returns cycle ID, name, start/end dates, and progress info.
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

            $cycles = $this->service->listCycles($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id']);

            $results = array_map(fn(array $cycle) => [
                'id' => $cycle['id'] ?? null,
                'name' => $cycle['name'] ?? null,
                'description' => $cycle['description'] ?? null,
                'start_date' => $cycle['start_date'] ?? null,
                'end_date' => $cycle['end_date'] ?? null,
                'is_active' => $cycle['is_active'] ?? null,
                'is_favorite' => $cycle['is_favorite'] ?? null,
                'created_at' => $cycle['created_at'] ?? null,
            ], $cycles);

            return ToolResult::success([
                'cycles' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
