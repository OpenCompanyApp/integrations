<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new branch in a GitLab project repository.
 */
class GitLabCreateBranch implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_create_branch';
    }

    public function description(): string
    {
        return 'Create a new branch in a GitLab project repository. Requires a branch name and a ref (branch name or commit SHA) to create from.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'branch' => ['type' => 'string', 'required' => true, 'description' => 'The name of the new branch. Example: "my-feature".'],
            'ref' => ['type' => 'string', 'required' => true, 'description' => 'The branch name or commit SHA to create from. Example: "main".'],
        ];
    }

    /**
     * Create a branch from a specific ref (branch or commit).
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, branch, ref)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';
        $branch = $args['branch'] ?? '';
        $ref = $args['ref'] ?? '';

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        if (empty($branch)) {
            return ToolResult::error('Branch name is required.');
        }

        if (empty($ref)) {
            return ToolResult::error('Ref (branch name or commit SHA) is required.');
        }

        try {
            $result = $this->service->createBranch($projectId, $branch, $ref);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
