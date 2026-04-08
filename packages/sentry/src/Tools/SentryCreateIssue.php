<?php

namespace OpenCompany\Integrations\Sentry\Tools;

use OpenCompany\Integrations\Sentry\SentryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SentryCreateIssue implements Tool
{
    public function __construct(
        private SentryService $service,
    ) {}

    public function name(): string
    {
        return 'sentry_create_issue';
    }

    public function description(): string
    {
        return 'Create a new issue (user report or crash report) in a Sentry project. Requires the error message and optional metadata like stacktrace, tags, and user context.';
    }

    public function parameters(): array
    {
        return [
            'org_slug' => ['type' => 'string', 'required' => true, 'description' => 'The organization slug (e.g., "my-org").'],
            'project_slug' => ['type' => 'string', 'required' => true, 'description' => 'The project slug (e.g., "my-project").'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Short description of the issue (the error message or title).'],
            'message' => ['type' => 'string', 'description' => 'Full error message or stacktrace.'],
            'level' => ['type' => 'string', 'description' => 'Severity level: "fatal", "error", "warning", "info", or "debug". Defaults to "error".'],
            'tags' => ['type' => 'object', 'description' => 'Key-value tags to attach to the issue (e.g., {"environment": "production", "version": "1.0.0"}).'],
            'extra' => ['type' => 'object', 'description' => 'Additional context data as key-value pairs.'],
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

            $title = $args['title'] ?? '';
            if (empty($title)) {
                return ToolResult::error('title is required.');
            }

            $data = [
                'title' => $title,
            ];

            if (isset($args['message'])) {
                $data['message'] = $args['message'];
            }

            if (isset($args['level'])) {
                $data['level'] = $args['level'];
            }

            if (isset($args['tags']) && is_array($args['tags'])) {
                $data['tags'] = $args['tags'];
            }

            if (isset($args['extra']) && is_array($args['extra'])) {
                $data['extra'] = $args['extra'];
            }

            $result = $this->service->createIssue($orgSlug, $projectSlug, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
