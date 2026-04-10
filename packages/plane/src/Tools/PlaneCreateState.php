<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new workflow state in a Plane.so project.
 */
class PlaneCreateState implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_create_state';
    }

    public function description(): string
    {
        return <<<'DESC'
Create a new workflow state in a Plane.so project. States represent issue statuses (e.g., "In Review", "Ready for QA").
Requires a name and group (backlog, unstarted, started, completed, cancelled). Optionally set color and description.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'State name (e.g., "In Review").'],
            'group' => ['type' => 'string', 'required' => true, 'description' => 'State group: backlog, unstarted, started, completed, cancelled.', 'enum' => ['backlog', 'unstarted', 'started', 'completed', 'cancelled']],
            'color' => ['type' => 'string', 'description' => 'Hex color code (e.g., "#FF5733").'],
            'description' => ['type' => 'string', 'description' => 'State description.'],
            'slug' => ['type' => 'string', 'description' => 'URL-friendly slug (auto-generated if omitted).'],
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

            $data = [
                'name' => $args['name'],
                'group' => $args['group'],
            ];

            foreach (['color', 'description', 'slug'] as $field) {
                if (isset($args[$field]) && $args[$field] !== '') {
                    $data[$field] = $args[$field];
                }
            }

            $state = $this->service->createState($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id'], $data);

            return ToolResult::success([
                'id' => $state['id'] ?? null,
                'name' => $state['name'] ?? null,
                'group' => $state['group'] ?? null,
                'color' => $state['color'] ?? null,
                'slug' => $state['slug'] ?? null,
                'created_at' => $state['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
