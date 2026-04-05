<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a comment to a GitHub issue or pull request.
 */
class GitHubCreateIssueComment implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_create_issue_comment';
    }

    public function description(): string
    {
        return 'Add a comment to a GitHub issue or pull request. The comment body supports GitHub Markdown.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'issue_number' => ['type' => 'integer', 'required' => true, 'description' => 'The issue or pull request number.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The comment body. Supports GitHub Markdown.'],
        ];
    }

    /**
     * Post a Markdown comment on an issue or pull request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, issue_number, body)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $issueNumber = $args['issue_number'] ?? null;
        $body = $args['body'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if ($issueNumber === null) {
            return ToolResult::error('issue_number is required.');
        }

        if (empty($body)) {
            return ToolResult::error('Comment body is required.');
        }

        try {
            $result = $this->service->createIssueComment($owner, $repo, (int) $issueNumber, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
