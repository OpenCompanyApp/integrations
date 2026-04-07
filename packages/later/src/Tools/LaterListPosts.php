<?php

namespace OpenCompany\Integrations\Later\Tools;

use OpenCompany\Integrations\Later\LaterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List posts in Later.
 *
 * Returns scheduled, published, or draft posts across social profiles,
 * with optional filtering by profile and status.
 */
class LaterListPosts implements Tool
{
    public function __construct(
        private LaterService $service,
    ) {}

    public function name(): string
    {
        return 'later_list_posts';
    }

    public function description(): string
    {
        return 'List scheduled and published posts in Later. Optionally filter by profile ID, status (scheduled, published, draft), and paginate results.';
    }

    public function parameters(): array
    {
        return [
            'profileId' => ['type' => 'string', 'description' => 'Filter posts by a specific social profile ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by post status: "scheduled", "published", or "draft".'],
            'limit' => ['type' => 'integer', 'description' => 'Number of posts to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Later integration is not configured.');
            }

            $result = $this->service->listPosts(
                profileId: $args['profileId'] ?? null,
                status: $args['status'] ?? null,
                limit: $args['limit'] ?? null,
                page: $args['page'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
