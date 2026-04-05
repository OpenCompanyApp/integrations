<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search issues in a GitLab project.
 */
class GitLabSearchIssues implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_search_issues';
    }

    public function description(): string
    {
        return 'Search for issues in a GitLab project by keyword. Searches issue titles and descriptions. Optionally filter by state.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'search' => ['type' => 'string', 'required' => true, 'description' => 'Search text to find in issue titles and descriptions.'],
            'state' => ['type' => 'string', 'description' => 'Issue state filter: opened, closed, all. Default: opened.'],
        ];
    }

    /**
     * Search issues by keyword with optional state filtering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, search, state)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';
        $search = $args['search'] ?? '';

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        if (empty($search)) {
            return ToolResult::error('Search query is required.');
        }

        try {
            $params = ['search' => $search];

            if (isset($args['state'])) {
                $params['state'] = $args['state'];
            }

            $result = $this->service->listIssues($projectId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
