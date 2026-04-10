<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new issue in a Plane.so project.
 */
class PlaneCreateIssue implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_create_issue';
    }

    public function description(): string
    {
        return <<<'DESC'
Create a new issue in a Plane.so project. Requires a title. Optionally set description (HTML), state, priority, assignees, labels, start/target dates, and parent issue.
DESC;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => ['type' => 'string', 'required' => false, 'description' => 'The workspace slug.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project UUID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Issue title.'],
            'description_html' => ['type' => 'string', 'description' => 'Issue description in HTML format.'],
            'state' => ['type' => 'string', 'description' => 'State UUID to set the initial status.'],
            'priority' => ['type' => 'string', 'description' => 'Priority level: urgent, high, medium, low, none.'],
            'assignees' => ['type' => 'array', 'description' => 'Array of user UUIDs to assign.'],
            'labels' => ['type' => 'array', 'description' => 'Array of label UUIDs.'],
            'start_date' => ['type' => 'string', 'description' => 'Start date (YYYY-MM-DD).'],
            'target_date' => ['type' => 'string', 'description' => 'Target/due date (YYYY-MM-DD).'],
            'parent' => ['type' => 'string', 'description' => 'Parent issue UUID for sub-issues.'],
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

            $data = ['name' => $args['name']];

            foreach (['description_html', 'state', 'priority', 'start_date', 'target_date', 'parent'] as $field) {
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

            $issue = $this->service->createIssue($workspaceSlug, $projectId, $data);

            return ToolResult::success([
                'id' => $issue['id'] ?? null,
                'name' => $issue['name'] ?? null,
                'sequence_id' => $issue['sequence_id'] ?? null,
                'state' => $issue['state'] ?? null,
                'priority' => $issue['priority'] ?? null,
                'created_at' => $issue['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
