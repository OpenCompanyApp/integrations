<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new merge request in a GitLab project.
 */
class GitLabCreateMergeRequest implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_create_merge_request';
    }

    public function description(): string
    {
        return 'Create a new merge request in a GitLab project. Requires source branch, target branch, and title.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'source_branch' => ['type' => 'string', 'required' => true, 'description' => 'The source branch name (where changes come from).'],
            'target_branch' => ['type' => 'string', 'required' => true, 'description' => 'The target branch name (where changes merge into).'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the merge request.'],
            'description' => ['type' => 'string', 'description' => 'The description of the merge request. Supports GitLab Markdown.'],
            'labels' => ['type' => 'string', 'description' => 'Comma-separated label names. Example: "feature,review".'],
        ];
    }

    /**
     * Create a merge request from a source branch to a target branch.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, source_branch, target_branch, title, description, labels)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';
        $sourceBranch = $args['source_branch'] ?? '';
        $targetBranch = $args['target_branch'] ?? '';
        $title = $args['title'] ?? '';

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        if (empty($sourceBranch)) {
            return ToolResult::error('source_branch is required.');
        }

        if (empty($targetBranch)) {
            return ToolResult::error('target_branch is required.');
        }

        if (empty($title)) {
            return ToolResult::error('Merge request title is required.');
        }

        try {
            $params = [];

            $mapping = [
                'source_branch' => 'source_branch',
                'target_branch' => 'target_branch',
                'title' => 'title',
                'description' => 'description',
                'labels' => 'labels',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createMergeRequest($projectId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
