<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all reviews on a GitHub pull request.
 */
class GitHubListPullRequestReviews implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_list_pull_request_reviews';
    }

    public function description(): string
    {
        return 'List all reviews on a GitHub pull request, including review state (approved, changes_requested, commented, dismissed).';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'pull_number' => ['type' => 'integer', 'required' => true, 'description' => 'The pull request number.'],
        ];
    }

    /**
     * Retrieve reviews with their state (approved, changes requested, etc.).
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, pull_number)
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
            $result = $this->service->listPullRequestReviews($owner, $repo, (int) $pullNumber);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
