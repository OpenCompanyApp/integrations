<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a file attachment to a Jira issue.
 */
class JiraAddAttachment implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_add_attachment';
    }

    public function description(): string
    {
        return 'Add a file attachment to a Jira issue. Provide the issue key, filename, and file content.';
    }

    public function parameters(): array
    {
        return [
            'issue_key' => ['type' => 'string', 'required' => true, 'description' => 'The issue key (e.g. PROJ-123).'],
            'filename' => ['type' => 'string', 'required' => true, 'description' => 'The name of the file to attach (e.g. "report.pdf").'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The file content (raw string or base64-encoded).'],
        ];
    }

    /**
     * Attach a file to the specified Jira issue.
     *
     * @param  array<string, mixed>  $args  Tool arguments (issue_key, filename, content)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $issueKey = $args['issue_key'] ?? '';
        $filename = $args['filename'] ?? '';
        $content = $args['content'] ?? '';

        if (empty($issueKey)) {
            return ToolResult::error('Issue key is required.');
        }

        if (empty($filename)) {
            return ToolResult::error('Filename is required.');
        }

        if (empty($content)) {
            return ToolResult::error('File content is required.');
        }

        try {
            $result = $this->service->addAttachment($issueKey, $filename, $content);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
