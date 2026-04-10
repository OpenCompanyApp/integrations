<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List labels in a Plane.so project.
 */
class PlaneListLabels implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_labels';
    }

    public function description(): string
    {
        return <<<'DESC'
List all labels in a Plane.so project. Returns label UUID, name, color, and parent label.
Use label UUIDs when creating or updating issues.
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

            $labels = $this->service->listLabels($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id']);

            $results = array_map(fn(array $label) => [
                'id' => $label['id'] ?? null,
                'name' => $label['name'] ?? null,
                'color' => $label['color'] ?? null,
                'description' => $label['description'] ?? null,
                'parent' => $label['parent'] ?? null,
            ], $labels);

            return ToolResult::success([
                'labels' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
