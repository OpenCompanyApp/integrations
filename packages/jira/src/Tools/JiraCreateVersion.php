<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new version (release) in a Jira project.
 */
class JiraCreateVersion implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_create_version';
    }

    public function description(): string
    {
        return 'Create a new version (release) in a Jira project. Requires project_key and name. Optionally set description, start_date, and release_date.';
    }

    public function parameters(): array
    {
        return [
            'project_key' => ['type' => 'string', 'required' => true, 'description' => 'The project key (e.g. PROJ).'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The version name (e.g. "v1.0.0").'],
            'description' => ['type' => 'string', 'description' => 'A description of the version.'],
            'start_date' => ['type' => 'string', 'description' => 'The start date in ISO 8601 format (e.g. "2024-01-15").'],
            'release_date' => ['type' => 'string', 'description' => 'The release date in ISO 8601 format (e.g. "2024-03-01").'],
        ];
    }

    /**
     * Create a new version in the specified Jira project.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_key, name, description, start_date, release_date)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $projectKey = $args['project_key'] ?? '';
        $name = $args['name'] ?? '';

        if (empty($projectKey)) {
            return ToolResult::error('Project key is required.');
        }

        if (empty($name)) {
            return ToolResult::error('Version name is required.');
        }

        try {
            $params = [
                'project' => $projectKey,
                'name' => $name,
            ];

            if (isset($args['description'])) {
                $params['description'] = $args['description'];
            }

            if (isset($args['start_date'])) {
                $params['startDate'] = $args['start_date'];
            }

            if (isset($args['release_date'])) {
                $params['releaseDate'] = $args['release_date'];
            }

            $result = $this->service->createVersion($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
