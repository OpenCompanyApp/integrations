<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Plane\PlaneService;

/**
 * Get details of a Plane.so project.
 */
class PlaneGetProject implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_get_project';
    }

    public function description(): string
    {
        return <<<'DESC'
Get detailed information about a Plane.so project, including name, identifier, description, status, dates, and settings.
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
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Plane.so integration is not configured.');
            }

            $project = $this->service->getProject($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $args['project_id']);

            return ToolResult::success([
                'id' => $project['id'] ?? null,
                'name' => $project['name'] ?? null,
                'identifier' => $project['identifier'] ?? null,
                'description' => $project['description'] ?? null,
                'cover_image' => $project['cover_image'] ?? null,
                'is_active' => PlaneService::isProjectActive($project),
                'is_archived' => ($project['archived_at'] ?? null) !== null,
                'is_deployed' => $project['is_deployed'] ?? null,
                'is_favorite' => $project['is_favorite'] ?? null,
                'is_member' => $project['is_member'] ?? null,
                'default_assignee' => $project['default_assignee'] ?? null,
                'project_lead' => $project['project_lead'] ?? null,
                'created_at' => $project['created_at'] ?? null,
                'updated_at' => $project['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
