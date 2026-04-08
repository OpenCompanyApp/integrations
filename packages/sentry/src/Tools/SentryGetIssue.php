<?php

namespace OpenCompany\Integrations\Sentry\Tools;

use OpenCompany\Integrations\Sentry\SentryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SentryGetIssue implements Tool
{
    public function __construct(
        private SentryService $service,
    ) {}

    public function name(): string
    {
        return 'sentry_get_issue';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Sentry issue, including the error message, stacktrace, tags, event count, and affected users.';
    }

    public function parameters(): array
    {
        return [
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'The Sentry issue ID (e.g., "1234567890").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sentry integration is not configured.');
            }

            $issueId = $args['issue_id'] ?? '';

            if (empty($issueId)) {
                return ToolResult::error('issue_id is required.');
            }

            $result = $this->service->getIssue($issueId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
