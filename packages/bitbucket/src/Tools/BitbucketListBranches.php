<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List branches in a Bitbucket repository.
 */
class BitbucketListBranches implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_list_branches';
    }

    public function description(): string
    {
        return 'List branches in a Bitbucket repository. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'pagelen' => ['type' => 'integer', 'description' => 'Number of results per page (1-100). Default: 10.'],
        ];
    }

    /**
     * Retrieve branches for the given repository.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, pagelen)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Bitbucket is not configured. Missing API key.');
        }

        $workspace = $args['workspace'] ?? '';
        $repoSlug = $args['repo_slug'] ?? '';

        if (empty($workspace) || empty($repoSlug)) {
            return ToolResult::error('Both workspace and repo_slug are required.');
        }

        try {
            $params = [];

            if (isset($args['pagelen'])) {
                $params['pagelen'] = $args['pagelen'];
            }

            $result = $this->service->listBranches($workspace, $repoSlug, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
