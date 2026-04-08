<?php

namespace OpenCompany\Integrations\Sentry\Tools;

use OpenCompany\Integrations\Sentry\SentryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SentryListReleases implements Tool
{
    public function __construct(
        private SentryService $service,
    ) {}

    public function name(): string
    {
        return 'sentry_list_releases';
    }

    public function description(): string
    {
        return 'List releases for a specific Sentry project. Returns version strings, deployment dates, authors, and commit information.';
    }

    public function parameters(): array
    {
        return [
            'org_slug' => ['type' => 'string', 'required' => true, 'description' => 'The organization slug (e.g., "my-org").'],
            'project_slug' => ['type' => 'string', 'required' => true, 'description' => 'The project slug (e.g., "my-project").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of releases to return (default: 25, max: 100).'],
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
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listReleases($orgSlug, $projectSlug, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
