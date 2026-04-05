<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List commits in a GitLab project repository.
 */
class GitLabListCommits implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_list_commits';
    }

    public function description(): string
    {
        return 'List commits in a GitLab project repository. Supports filtering by branch or tag name. Paginated.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'ref_name' => ['type' => 'string', 'description' => 'The name of the branch or tag to filter commits by.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination. Default: 1.'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (1-100). Default: 20.'],
        ];
    }

    /**
     * Retrieve commits with optional filtering by branch or tag name.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, ref_name, page, per_page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        try {
            $params = [];

            $mapping = [
                'ref_name' => 'ref_name',
                'page' => 'page',
                'per_page' => 'per_page',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listCommits($projectId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
