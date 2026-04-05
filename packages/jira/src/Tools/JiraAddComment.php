<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a comment to a Jira issue.
 */
class JiraAddComment implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_add_comment';
    }

    public function description(): string
    {
        return 'Add a comment to a Jira issue. Provide the issue key and the comment body text.';
    }

    public function parameters(): array
    {
        return [
            'issue_key' => ['type' => 'string', 'required' => true, 'description' => 'The issue key (e.g. PROJ-123).'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The comment text.'],
        ];
    }

    /**
     * Add a comment to the specified Jira issue.
     *
     * @param  array<string, mixed>  $args  Tool arguments (issue_key, body)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $issueKey = $args['issue_key'] ?? '';
        $body = $args['body'] ?? '';

        if (empty($issueKey)) {
            return ToolResult::error('Issue key is required.');
        }

        if (empty($body)) {
            return ToolResult::error('Comment body is required.');
        }

        try {
            $result = $this->service->addComment($issueKey, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
