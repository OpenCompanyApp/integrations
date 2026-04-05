<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new pull request in a GitHub repository.
 */
class GitHubCreatePullRequest implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_create_pull_request';
    }

    public function description(): string
    {
        return 'Create a new pull request in a GitHub repository. Requires a title, head branch (source), and base branch (target).';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the pull request.'],
            'body' => ['type' => 'string', 'description' => 'The body (description) of the pull request. Supports GitHub Markdown.'],
            'head' => ['type' => 'string', 'required' => true, 'description' => 'The name of the branch where your changes are implemented (source branch).'],
            'base' => ['type' => 'string', 'required' => true, 'description' => 'The name of the branch you want the changes pulled into (target branch).'],
            'draft' => ['type' => 'boolean', 'description' => 'Whether to create the pull request as a draft. Default: false.'],
        ];
    }

    /**
     * Create a pull request from a head branch to a base branch.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, title, body, head, base, draft)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $title = $args['title'] ?? '';
        $head = $args['head'] ?? '';
        $base = $args['base'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if (empty($title)) {
            return ToolResult::error('Pull request title is required.');
        }

        if (empty($head) || empty($base)) {
            return ToolResult::error('Both head and base branches are required.');
        }

        try {
            $params = [];

            $mapping = [
                'title' => 'title',
                'body' => 'body',
                'head' => 'head',
                'base' => 'base',
                'draft' => 'draft',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createPullRequest($owner, $repo, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
