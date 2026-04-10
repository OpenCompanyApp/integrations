<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List relations on a Plane.so issue.
 */
class PlaneListIssueRelations implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_issue_relations';
    }

    public function description(): string
    {
        return <<<'DESC'
List all relations on a Plane.so issue. Relations describe how issues connect: blocking, blocked_by, duplicate, relates_to, start_before, start_after, finish_before, finish_after.
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

            $relations = $this->service->listIssueRelations(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['issue_id'],
            );

            $results = array_map(fn(array $relation) => [
                'id' => $relation['id'] ?? null,
                'relation_type' => $relation['relation_type'] ?? null,
                'issue' => $relation['issue'] ?? null,
                'related_issue' => $relation['related_issue'] ?? null,
                'created_by' => $relation['created_by'] ?? null,
                'created_at' => $relation['created_at'] ?? null,
            ], $relations);

            return ToolResult::success([
                'relations' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
