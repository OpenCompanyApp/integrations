<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for issues and pull requests across GitHub.
 */
class GitHubSearchIssues implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_search_issues';
    }

    public function description(): string
    {
        return 'Search for issues and pull requests across all of GitHub. Supports GitHub search syntax like "repo:owner/repo is:issue is:open label:bug".';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query using GitHub search syntax. Can filter by repo, type, state, labels, assignees, etc. Example: "repo:octocat/hello-world is:issue is:open".'],
            'sort' => ['type' => 'string', 'description' => 'Sort field: comments, reactions, reactions-+1, reactions--1, reactions-heart, interactions, created, updated. Default: best match.'],
            'order' => ['type' => 'string', 'description' => 'Sort direction: asc or desc. Default: desc.'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (1-100). Default: 30.'],
        ];
    }

    /**
     * Search issues and pull requests using GitHub search syntax.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, sort, order, per_page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $query = $args['query'] ?? '';

        if (empty($query)) {
            return ToolResult::error('Search query is required.');
        }

        try {
            $params = ['q' => $query];

            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }
            if (isset($args['order'])) {
                $params['order'] = $args['order'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = $args['per_page'];
            }

            $result = $this->service->searchIssues($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
