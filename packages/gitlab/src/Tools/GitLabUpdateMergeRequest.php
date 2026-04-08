<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing merge request in a GitLab project.
 */
class GitLabUpdateMergeRequest implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_update_merge_request';
    }

    public function description(): string
    {
        return 'Update an existing merge request in a GitLab project. Can change title, description, labels, and state (close/reopen).';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'mr_iid' => ['type' => 'integer', 'required' => true, 'description' => 'The project-scoped merge request IID to update.'],
            'title' => ['type' => 'string', 'description' => 'New title for the merge request.'],
            'description' => ['type' => 'string', 'description' => 'New description for the merge request. Supports GitLab Markdown.'],
            'state_event' => ['type' => 'string', 'description' => 'State transition action: "close" to close, "reopen" to reopen.'],
            'labels' => ['type' => 'string', 'description' => 'Comma-separated label names. Replaces existing labels.'],
        ];
    }

    /**
     * Update a merge request's title, description, labels, or state.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, mr_iid, title, description, state_event, labels)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';
        $mrIid = $args['mr_iid'] ?? null;

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        if ($mrIid === null) {
            return ToolResult::error('mr_iid is required.');
        }

        try {
            $params = [];

            $mapping = [
                'title' => 'title',
                'description' => 'description',
                'state_event' => 'state_event',
                'labels' => 'labels',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (array_key_exists($argKey, $args)) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->updateMergeRequest($projectId, (int) $mrIid, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
