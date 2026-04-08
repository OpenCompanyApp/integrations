<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing issue in a GitHub repository.
 */
class GitHubUpdateIssue implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_update_issue';
    }

    public function description(): string
    {
        return 'Update an existing issue in a GitHub repository. Can change title, body, state (open/closed), assignees, labels, and milestone.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'issue_number' => ['type' => 'integer', 'required' => true, 'description' => 'The issue number to update.'],
            'title' => ['type' => 'string', 'description' => 'New title for the issue.'],
            'body' => ['type' => 'string', 'description' => 'New body (description) for the issue. Supports GitHub Markdown.'],
            'state' => ['type' => 'string', 'description' => 'New state: open or closed.'],
            'assignees' => ['type' => 'array', 'description' => 'Array of GitHub usernames to assign. Replaces existing assignees.'],
            'labels' => ['type' => 'array', 'description' => 'Array of label names. Replaces existing labels.'],
            'milestone' => ['type' => 'integer', 'description' => 'Milestone number to associate. Use null to clear.'],
        ];
    }

    /**
     * Update an issue's title, body, state, assignees, labels, or milestone.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, issue_number, title, body, state, assignees, labels, milestone)
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
            $params = [];

            $mapping = [
                'title' => 'title',
                'body' => 'body',
                'state' => 'state',
                'assignees' => 'assignees',
                'labels' => 'labels',
                'milestone' => 'milestone',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (array_key_exists($argKey, $args)) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->updateIssue($owner, $repo, (int) $issueNumber, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
