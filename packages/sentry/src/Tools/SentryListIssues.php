<?php

namespace OpenCompany\Integrations\Sentry\Tools;

use OpenCompany\Integrations\Sentry\SentryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SentryListIssues implements Tool
{
    public function __construct(
        private SentryService $service,
    ) {}

    public function name(): string
    {
        return 'sentry_list_issues';
    }

    public function description(): string
    {
        return 'List issues (errors) for a specific Sentry project. Supports filtering by status, query, sorting, and time range. Returns issue IDs, titles, counts, and severity.';
    }

    public function parameters(): array
    {
        return [
            'org_slug' => ['type' => 'string', 'required' => true, 'description' => 'The organization slug (e.g., "my-org").'],
            'project_slug' => ['type' => 'string', 'required' => true, 'description' => 'The project slug (e.g., "my-project").'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter issues (e.g., "is:unresolved level:error").'],
            'sort' => ['type' => 'string', 'description' => 'Sort order: "date" (default), "freq", "new", "priority".'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of issues to return (default: 25, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sentry integration is not configured.');
            }

            $orgSlug = $args['org_slug'] ?? '';
            $projectSlug = $args['project_slug'] ?? '';

            if (empty($orgSlug) || empty($projectSlug)) {
                return ToolResult::error('Both org_slug and project_slug are required.');
            }

            $params = [];
            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }
            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listIssues($orgSlug, $projectSlug, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
