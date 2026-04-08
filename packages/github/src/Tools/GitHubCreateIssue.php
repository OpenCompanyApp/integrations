<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new issue in a GitHub repository.
 */
class GitHubCreateIssue implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_create_issue';
    }

    public function description(): string
    {
        return 'Create a new issue in a GitHub repository. Requires a title. Optionally set body, assignees, labels, and milestone.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the issue.'],
            'body' => ['type' => 'string', 'description' => 'The body (description) of the issue. Supports GitHub Markdown.'],
            'assignees' => ['type' => 'array', 'description' => 'Array of GitHub usernames to assign to the issue. Example: ["octocat"].'],
            'labels' => ['type' => 'array', 'description' => 'Array of label names to apply. Example: ["bug", "help wanted"].'],
            'milestone' => ['type' => 'integer', 'description' => 'The milestone number to associate with the issue.'],
        ];
    }

    /**
     * Create an issue with optional body, assignees, labels, and milestone.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, title, body, assignees, labels, milestone)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $title = $args['title'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if (empty($title)) {
            return ToolResult::error('Issue title is required.');
        }

        try {
            $params = [];

            $mapping = [
                'title' => 'title',
                'body' => 'body',
                'assignees' => 'assignees',
                'labels' => 'labels',
                'milestone' => 'milestone',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createIssue($owner, $repo, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
