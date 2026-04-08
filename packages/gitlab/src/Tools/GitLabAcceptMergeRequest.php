<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Accept (merge) a GitLab merge request.
 */
class GitLabAcceptMergeRequest implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_accept_merge_request';
    }

    public function description(): string
    {
        return 'Accept (merge) a GitLab merge request. Optionally set a custom merge commit message.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'mr_iid' => ['type' => 'integer', 'required' => true, 'description' => 'The project-scoped merge request IID to accept.'],
            'merge_commit_message' => ['type' => 'string', 'description' => 'Custom merge commit message.'],
        ];
    }

    /**
     * Accept a merge request, optionally with a custom commit message.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, mr_iid, merge_commit_message)
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

            if (isset($args['merge_commit_message'])) {
                $params['merge_commit_message'] = $args['merge_commit_message'];
            }

            $result = $this->service->acceptMergeRequest($projectId, (int) $mrIid, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
