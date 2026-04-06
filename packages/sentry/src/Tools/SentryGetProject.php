<?php

namespace OpenCompany\Integrations\Sentry\Tools;

use OpenCompany\Integrations\Sentry\SentryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SentryGetProject implements Tool
{
    public function __construct(
        private SentryService $service,
    ) {}

    public function name(): string
    {
        return 'sentry_get_project';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Sentry project, including its slug, platform, team assignments, and error statistics.';
    }

    public function parameters(): array
    {
        return [
            'org_slug' => ['type' => 'string', 'required' => true, 'description' => 'The organization slug (e.g., "my-org").'],
            'project_slug' => ['type' => 'string', 'required' => true, 'description' => 'The project slug (e.g., "my-project").'],
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

            $result = $this->service->getProject($orgSlug, $projectSlug);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
