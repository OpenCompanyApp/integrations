<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Plane\PlaneService;

/**
 * Get a single Plane.so issue by ID.
 */
class PlaneGetIssue implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_get_issue';
    }

    public function description(): string
    {
        return <<<'DESC'
Get detailed information about a single Plane.so issue, including description, state, priority, assignees, labels, dates, and relations.
The issue_id may be a UUID or an issue reference like KOS-55 on Plane deployments that support it.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'The issue UUID or reference (for example KOS-55).'],
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

            $issue = $this->service->getIssue(
                $this->service->resolveWorkspaceSlug($args['workspace_slug'] ?? null),
                $args['project_id'],
                $args['issue_id'],
            );

            return ToolResult::success([
                'id' => $issue['id'] ?? null,
                'name' => $issue['name'] ?? null,
                'sequence_id' => $issue['sequence_id'] ?? null,
                'description_html' => $issue['description_html'] ?? null,
                'state' => $issue['state'] ?? null,
                'priority' => $issue['priority'] ?? null,
                'start_date' => $issue['start_date'] ?? null,
                'target_date' => $issue['target_date'] ?? null,
                'assignees' => $issue['assignees'] ?? [],
                'labels' => $issue['labels'] ?? [],
                'parent' => $issue['parent'] ?? null,
                'created_by' => $issue['created_by'] ?? null,
                'created_at' => $issue['created_at'] ?? null,
                'updated_at' => $issue['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
