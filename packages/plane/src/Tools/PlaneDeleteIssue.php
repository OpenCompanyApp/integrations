<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete an issue from a Plane.so project.
 */
class PlaneDeleteIssue implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_delete_issue';
    }

    public function description(): string
    {
        return <<<'DESC'
Delete an issue from a Plane.so project. This action is permanent and cannot be undone.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'The issue UUID to delete.'],
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

            $this->service->deleteIssue(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['issue_id'],
            );

            return ToolResult::success([
                'deleted' => true,
                'issue_id' => $args['issue_id'],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
