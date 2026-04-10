<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Plane\PlaneService;

/**
 * Search issues across a Plane.so workspace.
 */
class PlaneSearchIssues implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_search_issues';
    }

    public function description(): string
    {
        return <<<'DESC'
Search issues across all projects in a Plane.so workspace. Provide a search query to find issues by name or description.
Optionally filter by project, state, priority, or assignee.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'search' => ['type' => 'string', 'required' => true, 'description' => 'Search query to find issues.'],
            'project' => ['type' => 'string', 'description' => 'Filter by project UUID.'],
            'state' => ['type' => 'string', 'description' => 'Filter by state UUID.'],
            'priority' => ['type' => 'string', 'description' => 'Filter by priority: urgent, high, medium, low, none.'],
            'assignee' => ['type' => 'string', 'description' => 'Filter by assignee UUID.'],
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

            $params = ['search' => $args['search']];

            foreach (['project', 'state', 'priority', 'assignee'] as $key) {
                if (isset($args[$key]) && $args[$key] !== '') {
                    $params[$key] = $args[$key];
                }
            }

            $issues = PlaneService::filterIssues(
                $this->service->searchIssues($this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null), $params),
                $params,
            );

            $results = array_map(fn (array $issue) => [
                'id' => $issue['id'] ?? null,
                'name' => $issue['name'] ?? null,
                'sequence_id' => $issue['sequence_id'] ?? null,
                'project' => $issue['project'] ?? null,
                'project_detail' => $issue['project_detail'] ?? null,
                'state' => $issue['state'] ?? null,
                'priority' => $issue['priority'] ?? null,
                'assignees' => $issue['assignees'] ?? [],
                'created_at' => $issue['created_at'] ?? null,
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
