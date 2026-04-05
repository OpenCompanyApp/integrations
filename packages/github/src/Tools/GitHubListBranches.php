<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List branches in a GitHub repository.
 */
class GitHubListBranches implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_list_branches';
    }

    public function description(): string
    {
        return 'List branches in a GitHub repository. Returns branch names and the SHA of each branch\'s latest commit.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (1-100). Default: 30.'],
        ];
    }

    /**
     * Retrieve branch names and their latest commit SHAs.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, per_page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        try {
            $params = [];

            if (isset($args['per_page'])) {
                $params['per_page'] = $args['per_page'];
            }

            $result = $this->service->listBranches($owner, $repo, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
