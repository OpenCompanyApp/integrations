<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new cycle (sprint) in a Plane.so project.
 */
class PlaneCreateCycle implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_create_cycle';
    }

    public function description(): string
    {
        return <<<'DESC'
Create a new cycle (sprint) in a Plane.so project. Optionally set name, description, and date range.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'name' => ['type' => 'string', 'description' => 'Cycle name (e.g., "Sprint 14").'],
            'description' => ['type' => 'string', 'description' => 'Cycle description.'],
            'start_date' => ['type' => 'string', 'description' => 'Start date (YYYY-MM-DD).'],
            'end_date' => ['type' => 'string', 'description' => 'End date (YYYY-MM-DD).'],
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

            $data = [];

            foreach (['name', 'description', 'start_date', 'end_date'] as $field) {
                if (isset($args[$field]) && $args[$field] !== '') {
                    $data[$field] = $args[$field];
                }
            }

            $cycle = $this->service->createCycle($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id'], $data);

            return ToolResult::success([
                'id' => $cycle['id'] ?? null,
                'name' => $cycle['name'] ?? null,
                'start_date' => $cycle['start_date'] ?? null,
                'end_date' => $cycle['end_date'] ?? null,
                'created_at' => $cycle['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
