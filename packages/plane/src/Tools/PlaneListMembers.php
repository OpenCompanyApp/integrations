<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List members of a Plane.so workspace or project.
 */
class PlaneListMembers implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_members';
    }

    public function description(): string
    {
        return <<<'DESC'
List members of a Plane.so workspace or project. If project_id is provided, returns project members only; otherwise returns all workspace members.
Returns member ID, display name, email, and role.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'description' => 'Optional project UUID to list project-specific members.'],
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

            $workspaceSlug = $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null);
            $projectId = $args['project_id'] ?? null;

            if ($projectId !== null && $projectId !== '') {
                $members = $this->service->listProjectMembers($workspaceSlug, $projectId);
            } else {
                $members = $this->service->listWorkspaceMembers($workspaceSlug);
            }

            $results = array_map(function (array $member) {
                $data = $member['member'] ?? $member;

                return [
                    'id' => $data['id'] ?? null,
                    'display_name' => $data['display_name'] ?? null,
                    'email' => $data['email'] ?? null,
                    'role' => $member['role'] ?? $data['role'] ?? null,
                ];
            }, $members);

            return ToolResult::success([
                'members' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
