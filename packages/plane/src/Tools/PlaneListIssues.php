<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Plane\PlaneService;

/**
 * List issues in a Plane.so project.
 */
class PlaneListIssues implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_list_issues';
    }

    public function description(): string
    {
        return <<<'DESC'
List issues in a Plane.so project. Supports filtering by state, priority, assignee, labels, and more.
Returns issue ID, name, sequence ID, state, priority, assignees, labels, start/target dates, and created date.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'state' => ['type' => 'string', 'description' => 'Filter by state UUID.'],
            'priority' => ['type' => 'string', 'description' => 'Filter by priority: urgent, high, medium, low, none.'],
            'assignee' => ['type' => 'string', 'description' => 'Filter by assignee UUID.'],
            'labels' => ['type' => 'string', 'description' => 'Comma-separated label UUIDs to filter by.'],
            'search' => ['type' => 'string', 'description' => 'Search query to filter issues by name.'],
            'parent' => ['type' => 'string', 'description' => 'Filter by parent issue UUID.'],
            'cycle' => ['type' => 'string', 'description' => 'Filter by cycle UUID.'],
            'module' => ['type' => 'string', 'description' => 'Filter by module UUID.'],
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

            $workspaceSlug = $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null);
            $projectId = $args['project_id'];

            $params = [];
            foreach (['state', 'priority', 'assignee', 'labels', 'search', 'parent', 'cycle', 'module'] as $key) {
                if (isset($args[$key]) && $args[$key] !== '') {
                    $params[$key] = $args[$key];
                }
            }

            $issues = PlaneService::filterIssues(
                array_map(static function (array $issue) use ($projectId): array {
                    $issue['project'] ??= $projectId;

                    return $issue;
                }, $this->service->listIssues($workspaceSlug, $projectId, $params)),
                array_merge($params, ['project' => $projectId]),
            );

            $results = array_map(fn (array $issue) => [
                'id' => $issue['id'] ?? null,
                'name' => $issue['name'] ?? null,
                'sequence_id' => $issue['sequence_id'] ?? null,
                'state' => $issue['state'] ?? null,
                'priority' => $issue['priority'] ?? null,
                'start_date' => $issue['start_date'] ?? null,
                'target_date' => $issue['target_date'] ?? null,
                'assignees' => $issue['assignees'] ?? [],
                'labels' => $issue['labels'] ?? [],
                'created_at' => $issue['created_at'] ?? null,
                'updated_at' => $issue['updated_at'] ?? null,
            ], $issues);

            return ToolResult::success([
                'issues' => $results,
                'count' => count($results),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
