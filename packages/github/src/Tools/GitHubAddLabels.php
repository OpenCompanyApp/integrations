<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add one or more labels to a GitHub issue.
 */
class GitHubAddLabels implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_add_labels';
    }

    public function description(): string
    {
        return 'Add one or more labels to a GitHub issue. Labels are specified by name. If a label does not exist in the repository, it will be created.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'issue_number' => ['type' => 'integer', 'required' => true, 'description' => 'The issue number.'],
            'labels' => ['type' => 'array', 'required' => true, 'description' => 'Array of label names to add. Example: ["bug", "enhancement"].'],
        ];
    }

    /**
     * Add labels to an issue in a repository. Non-existent labels are created automatically.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, issue_number, labels)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $issueNumber = $args['issue_number'] ?? null;
        $labels = $args['labels'] ?? [];

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if ($issueNumber === null) {
            return ToolResult::error('issue_number is required.');
        }

        if (empty($labels)) {
            return ToolResult::error('At least one label is required.');
        }

        try {
            $result = $this->service->addLabels($owner, $repo, (int) $issueNumber, $labels);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
