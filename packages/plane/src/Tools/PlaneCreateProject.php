<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new project in a Plane.so workspace.
 */
class PlaneCreateProject implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_create_project';
    }

    public function description(): string
    {
        return <<<'DESC'
Create a new project in a Plane.so workspace. Requires a name and identifier (short code, e.g., "PROJ").
Optionally set description, cover image, project lead, and default assignee.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Project name.'],
            'identifier' => ['type' => 'string', 'required' => true, 'description' => 'Short identifier for the project (e.g., "PROJ", max 12 chars).'],
            'description' => ['type' => 'string', 'description' => 'Project description.'],
            'cover_image' => ['type' => 'string', 'description' => 'URL for the project cover image.'],
            'project_lead' => ['type' => 'string', 'description' => 'UUID of the project lead member.'],
            'default_assignee' => ['type' => 'string', 'description' => 'UUID of the default assignee for new issues.'],
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
                'identifier' => $args['identifier'],
            ];

            foreach (['description', 'cover_image', 'project_lead', 'default_assignee'] as $field) {
                if (isset($args[$field]) && $args[$field] !== '') {
                    $data[$field] = $args[$field];
                }
            }

            $project = $this->service->createProject($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $data);

            return ToolResult::success([
                'id' => $project['id'] ?? null,
                'name' => $project['name'] ?? null,
                'identifier' => $project['identifier'] ?? null,
                'created_at' => $project['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
