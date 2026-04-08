<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific GitHub issue.
 */
class GitHubGetIssue implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_get_issue';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific GitHub issue, including title, body, labels, assignees, milestone, and comments count.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'issue_number' => ['type' => 'integer', 'required' => true, 'description' => 'The issue number.'],
        ];
    }

    /**
     * Retrieve issue details including title, body, labels, and assignees.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, issue_number)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $issueNumber = $args['issue_number'] ?? null;

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if ($issueNumber === null) {
            return ToolResult::error('issue_number is required.');
        }

        try {
            $result = $this->service->getIssue($owner, $repo, (int) $issueNumber);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
