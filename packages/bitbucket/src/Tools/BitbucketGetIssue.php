<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Bitbucket issue.
 */
class BitbucketGetIssue implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_get_issue';
    }

    public function description(): string
    {
        return 'Get details for a specific issue in a Bitbucket repository.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'issue_id' => ['type' => 'integer', 'required' => true, 'description' => 'The issue identifier.'],
        ];
    }

    /**
     * Fetch issue details for the given repository and issue ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, issue_id)
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
            $result = $this->service->getIssue($workspace, $repoSlug, (int) $issueId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
