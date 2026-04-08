<?php

namespace OpenCompany\Integrations\Beamer\Tools;

use OpenCompany\Integrations\Beamer\BeamerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List changelog posts and announcements from Beamer.
 *
 * Supports pagination and filtering by publication status.
 * Returns an array of post objects including title, content, date, and category.
 */
class BeamerListPosts implements Tool
{
    public function __construct(
        private BeamerService $service,
    ) {}

    public function name(): string
    {
        return 'beamer_list_posts';
    }

    public function description(): string
    {
        return 'List changelog posts and announcements from Beamer. Supports pagination with limit and page, and filtering by status (published, draft, scheduled).';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of posts to return (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by publication status: "published", "draft", or "scheduled".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beamer integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $page = isset($args['page']) ? (int) $args['page'] : null;
            $status = $args['status'] ?? null;

            $result = $this->service->listPosts($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
