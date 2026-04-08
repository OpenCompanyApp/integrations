<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a comment to an existing Linear issue.
 */
class LinearCreateComment implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_create_comment';
    }

    public function description(): string
    {
        return <<<'MD'
        Add a comment to a Linear issue. Supports markdown formatting.
        Provide the issue ID or identifier and the comment body.
        MD;
    }

    public function parameters(): array
    {
        return [
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'Issue ID or identifier to comment on.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Comment body text (markdown supported).'],
        ];
    }

    /**
     * Create a comment on a Linear issue.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $issueId = $args['issue_id'] ?? '';
            $body = $args['body'] ?? '';

            if (empty($issueId)) {
                return ToolResult::error('issue_id is required.');
            }
            if (empty($body)) {
                return ToolResult::error('body is required.');
            }

            $result = $this->service->createComment($issueId, $body);
            $comment = $result['data']['commentCreate']['comment'] ?? null;

            if ($comment === null) {
                return ToolResult::error('Failed to create comment.');
            }

            return ToolResult::success([
                'id' => $comment['id'] ?? '',
                'body' => $comment['body'] ?? '',
                'user' => $comment['user']['name'] ?? '',
                'created_at' => $comment['createdAt'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
