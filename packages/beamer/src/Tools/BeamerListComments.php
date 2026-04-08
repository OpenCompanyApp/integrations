<?php

namespace OpenCompany\Integrations\Beamer\Tools;

use OpenCompany\Integrations\Beamer\BeamerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List comments on a specific Beamer post.
 *
 * Returns all comments associated with the given post ID, including
 * commenter details and timestamps.
 */
class BeamerListComments implements Tool
{
    public function __construct(
        private BeamerService $service,
    ) {}

    public function name(): string
    {
        return 'beamer_list_comments';
    }

    public function description(): string
    {
        return 'List all comments on a specific Beamer post. Returns comment text, author info, and timestamps.';
    }

    public function parameters(): array
    {
        return [
            'post_id' => ['type' => 'integer', 'required' => true, 'description' => 'The post ID to list comments for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beamer integration is not configured.');
            }

            $result = $this->service->listComments($args['post_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
