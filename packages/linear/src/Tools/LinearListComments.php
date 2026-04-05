<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all comments on a Linear issue.
 */
class LinearListComments implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_list_comments';
    }

    public function description(): string
    {
        return <<<'MD'
        List all comments on a Linear issue, ordered chronologically.
        Provide the issue ID or identifier.
        MD;
    }

    public function parameters(): array
    {
        return [
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'Issue ID or identifier to list comments for.'],
        ];
    }

    /**
     * List comments on a Linear issue.
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
            if (empty($issueId)) {
                return ToolResult::error('issue_id is required.');
            }

            $result = $this->service->listComments($issueId);
            $comments = $result['data']['issue']['comments']['nodes'] ?? [];

            $nodes = array_map(function (array $comment) {
                return [
                    'id' => $comment['id'] ?? '',
                    'body' => $comment['body'] ?? '',
                    'user' => $comment['user']['name'] ?? '',
                    'created_at' => $comment['createdAt'] ?? '',
                    'updated_at' => $comment['updatedAt'] ?? '',
                ];
            }, $comments);

            return ToolResult::success([
                'comments' => $nodes,
                'total' => count($nodes),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
