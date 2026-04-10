<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List activity events on a Plane.so issue.
 */
class PlaneListIssueActivities implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_issue_activities';
    }

    public function description(): string
    {
        return <<<'DESC'
List activity/audit events on a Plane.so issue. Returns changes made to the issue (state changes, assignments, updates, comments) with who made them and when.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'The issue UUID.'],
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

            $activities = $this->service->listActivities(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['issue_id'],
            );

            $results = array_map(fn(array $activity) => [
                'id' => $activity['id'] ?? null,
                'action' => $activity['action'] ?? null,
                'field' => $activity['field'] ?? null,
                'old_value' => $activity['old_value'] ?? null,
                'new_value' => $activity['new_value'] ?? null,
                'created_by' => $activity['created_by'] ?? null,
                'created_at' => $activity['created_at'] ?? null,
            ], $activities);

            return ToolResult::success([
                'activities' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
