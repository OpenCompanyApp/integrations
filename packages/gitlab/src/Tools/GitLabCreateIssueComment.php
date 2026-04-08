<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a comment (note) to a GitLab issue.
 */
class GitLabCreateIssueComment implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_create_issue_comment';
    }

    public function description(): string
    {
        return 'Add a comment (note) to a GitLab issue. The comment body supports GitLab Markdown.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'issue_iid' => ['type' => 'integer', 'required' => true, 'description' => 'The project-scoped issue IID.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The comment body. Supports GitLab Markdown.'],
        ];
    }

    /**
     * Post a Markdown comment on an issue.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, issue_iid, body)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';
        $issueIid = $args['issue_iid'] ?? null;
        $body = $args['body'] ?? '';

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        if ($issueIid === null) {
            return ToolResult::error('issue_iid is required.');
        }

        if (empty($body)) {
            return ToolResult::error('Comment body is required.');
        }

        try {
            $result = $this->service->createIssueNote($projectId, (int) $issueIid, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
