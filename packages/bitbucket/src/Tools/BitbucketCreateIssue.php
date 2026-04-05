<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new issue in a Bitbucket repository.
 */
class BitbucketCreateIssue implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_create_issue';
    }

    public function description(): string
    {
        return 'Create a new issue in a Bitbucket repository. Requires a title; optionally set content, kind, priority, and assignee.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the issue.'],
            'content' => ['type' => 'string', 'description' => 'The issue description (Markdown supported).'],
            'kind' => ['type' => 'string', 'description' => 'Issue kind: bug, enhancement, proposal, task. Default: bug.'],
            'priority' => ['type' => 'string', 'description' => 'Issue priority: trivial, minor, major, critical, blocker. Default: major.'],
            'assignee' => ['type' => 'string', 'description' => 'The UUID of the user to assign the issue to.'],
        ];
    }

    /**
     * Create an issue with title, optional content, kind, priority, and assignee.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, title, content, kind, priority, assignee)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Bitbucket is not configured. Missing API key.');
        }

        $workspace = $args['workspace'] ?? '';
        $repoSlug = $args['repo_slug'] ?? '';
        $title = $args['title'] ?? '';

        if (empty($workspace) || empty($repoSlug)) {
            return ToolResult::error('Both workspace and repo_slug are required.');
        }

        if (empty($title)) {
            return ToolResult::error('Issue title is required.');
        }

        try {
            $params = ['title' => $title];

            if (isset($args['content'])) {
                $params['content'] = ['raw' => $args['content']];
            }

            $directParams = ['kind', 'priority'];
            foreach ($directParams as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            if (isset($args['assignee'])) {
                $params['assignee'] = ['uuid' => $args['assignee']];
            }

            $result = $this->service->createIssue($workspace, $repoSlug, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
