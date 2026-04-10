<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing issue in a Plane.so project.
 */
class PlaneUpdateIssue implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_update_issue';
    }

    public function description(): string
    {
        return <<<'DESC'
Update an existing Plane.so issue. Provide only the fields you want to change — name, description, state, priority, assignees, labels, dates, or parent.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'The issue UUID.'],
            'name' => ['type' => 'string', 'description' => 'New issue title.'],
            'description_html' => ['type' => 'string', 'description' => 'New description in HTML format.'],
            'state' => ['type' => 'string', 'description' => 'New state UUID.'],
            'priority' => ['type' => 'string', 'description' => 'New priority: urgent, high, medium, low, none.'],
            'assignees' => ['type' => 'array', 'description' => 'New array of assignee UUIDs (replaces existing).'],
            'labels' => ['type' => 'array', 'description' => 'New array of label UUIDs (replaces existing).'],
            'start_date' => ['type' => 'string', 'description' => 'New start date (YYYY-MM-DD).'],
            'target_date' => ['type' => 'string', 'description' => 'New target/due date (YYYY-MM-DD).'],
            'parent' => ['type' => 'string', 'description' => 'New parent issue UUID.'],
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
            $projectId = $args['project_id'];
            $issueId = $args['issue_id'];

            $data = [];
            foreach (['name', 'description_html', 'state', 'priority', 'start_date', 'target_date', 'parent'] as $field) {
                if (isset($args[$field]) && $args[$field] !== '') {
                    $data[$field] = $args[$field];
                }
            }

            if (isset($args['assignees']) && is_array($args['assignees'])) {
                $data['assignees'] = $args['assignees'];
            }

            if (isset($args['labels']) && is_array($args['labels'])) {
                $data['labels'] = $args['labels'];
            }

            if (empty($data)) {
                return ToolResult::error('No fields provided to update.');
            }

            $issue = $this->service->updateIssue($workspaceSlug, $projectId, $issueId, $data);

            return ToolResult::success([
                'id' => $issue['id'] ?? null,
                'name' => $issue['name'] ?? null,
                'sequence_id' => $issue['sequence_id'] ?? null,
                'state' => $issue['state'] ?? null,
                'priority' => $issue['priority'] ?? null,
                'updated_at' => $issue['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
