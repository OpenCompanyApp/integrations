<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing pull request in a GitHub repository.
 */
class GitHubUpdatePullRequest implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_update_pull_request';
    }

    public function description(): string
    {
        return 'Update an existing pull request in a GitHub repository. Can change title, body, state (open/closed), and base branch.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'pull_number' => ['type' => 'integer', 'required' => true, 'description' => 'The pull request number to update.'],
            'title' => ['type' => 'string', 'description' => 'New title for the pull request.'],
            'body' => ['type' => 'string', 'description' => 'New body (description) for the pull request. Supports GitHub Markdown.'],
            'state' => ['type' => 'string', 'description' => 'New state: open or closed.'],
            'base' => ['type' => 'string', 'description' => 'New base branch name.'],
        ];
    }

    /**
     * Update a pull request's title, body, state, or base branch.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, pull_number, title, body, state, base)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $pullNumber = $args['pull_number'] ?? null;

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if ($pullNumber === null) {
            return ToolResult::error('pull_number is required.');
        }

        try {
            $params = [];

            $mapping = [
                'title' => 'title',
                'body' => 'body',
                'state' => 'state',
                'base' => 'base',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (array_key_exists($argKey, $args)) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->updatePullRequest($owner, $repo, (int) $pullNumber, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
