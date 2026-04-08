<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing issue in a Bitbucket repository.
 */
class BitbucketUpdateIssue implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_update_issue';
    }

    public function description(): string
    {
        return 'Update an existing issue in a Bitbucket repository. Can change title, content, state, priority, and assignee.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'issue_id' => ['type' => 'integer', 'required' => true, 'description' => 'The issue identifier.'],
            'title' => ['type' => 'string', 'description' => 'The new title of the issue.'],
            'content' => ['type' => 'string', 'description' => 'The new issue description (Markdown supported).'],
            'state' => ['type' => 'string', 'description' => 'New state: new, open, resolved, closed, on hold, wontfix, duplicate, invalid.'],
            'priority' => ['type' => 'string', 'description' => 'New priority: trivial, minor, major, critical, blocker.'],
            'assignee' => ['type' => 'string', 'description' => 'The UUID of the user to assign the issue to.'],
        ];
    }

    /**
     * Update an issue with the given fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, issue_id, title, content, state, priority, assignee)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Bitbucket is not configured. Missing API key.');
        }

        $workspace = $args['workspace'] ?? '';
        $repoSlug = $args['repo_slug'] ?? '';
        $issueId = $args['issue_id'] ?? null;

        if (empty($workspace) || empty($repoSlug)) {
            return ToolResult::error('Both workspace and repo_slug are required.');
        }

        if ($issueId === null) {
            return ToolResult::error('issue_id is required.');
        }

        try {
            $params = [];

            if (isset($args['title'])) {
                $params['title'] = $args['title'];
            }

            if (isset($args['content'])) {
                $params['content'] = ['raw' => $args['content']];
            }

            $directParams = ['state', 'priority'];
            foreach ($directParams as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            if (isset($args['assignee'])) {
                $params['assignee'] = ['uuid' => $args['assignee']];
            }

            $result = $this->service->updateIssue($workspace, $repoSlug, (int) $issueId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
