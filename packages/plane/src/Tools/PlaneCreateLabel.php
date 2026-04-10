<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new label in a Plane.so project.
 */
class PlaneCreateLabel implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_create_label';
    }

    public function description(): string
    {
        return <<<'DESC'
Create a new label in a Plane.so project. Labels categorize issues (e.g., "bug", "feature", "urgent").
Requires a name. Optionally set color (hex) and description. Supports hierarchical labels via parent UUID.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Label name.'],
            'color' => ['type' => 'string', 'description' => 'Hex color code (e.g., "#FF5733").'],
            'description' => ['type' => 'string', 'description' => 'Label description.'],
            'parent' => ['type' => 'string', 'description' => 'Parent label UUID for hierarchical labels.'],
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

            foreach (['color', 'description', 'parent'] as $field) {
                if (isset($args[$field]) && $args[$field] !== '') {
                    $data[$field] = $args[$field];
                }
            }

            $label = $this->service->createLabel($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id'], $data);

            return ToolResult::success([
                'id' => $label['id'] ?? null,
                'name' => $label['name'] ?? null,
                'color' => $label['color'] ?? null,
                'created_at' => $label['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
