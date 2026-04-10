<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new module in a Plane.so project.
 */
class PlaneCreateModule implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_create_module';
    }

    public function description(): string
    {
        return <<<'DESC'
Create a new module in a Plane.so project. Modules group related issues together (e.g., "Auth System", "Payment Integration").
Optionally set description, status, and date range.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Module name.'],
            'description' => ['type' => 'string', 'description' => 'Module description.'],
            'status' => ['type' => 'string', 'description' => 'Module status (e.g., "planning", "in_progress", "completed").'],
            'start_date' => ['type' => 'string', 'description' => 'Start date (YYYY-MM-DD).'],
            'target_date' => ['type' => 'string', 'description' => 'Target date (YYYY-MM-DD).'],
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

            $data = ['name' => $args['name']];

            foreach (['description', 'status', 'start_date', 'target_date'] as $field) {
                if (isset($args[$field]) && $args[$field] !== '') {
                    $data[$field] = $args[$field];
                }
            }

            $module = $this->service->createModule($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id'], $data);

            return ToolResult::success([
                'id' => $module['id'] ?? null,
                'name' => $module['name'] ?? null,
                'status' => $module['status'] ?? null,
                'created_at' => $module['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
