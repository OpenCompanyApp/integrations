<?php

namespace OpenCompany\Integrations\SproutSocial\Tools;

use OpenCompany\Integrations\SproutSocial\SproutSocialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List posts in Sprout Social.
 *
 * Returns a list of posts across social profiles with optional
 * filtering by status (sent, scheduled, draft) and pagination.
 */
class SproutSocialListPosts implements Tool
{
    public function __construct(
        private SproutSocialService $service,
    ) {}

    public function name(): string
    {
        return 'sproutsocial_list_posts';
    }

    public function description(): string
    {
        return 'List posts across social profiles in Sprout Social. Optionally filter by status (sent, scheduled, draft) and paginate results.';
    }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Number of posts to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'status' => ['type' => 'string', 'description' => 'Filter by post status: "sent", "scheduled", or "draft".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sprout Social integration is not configured.');
            }

            $result = $this->service->listPosts(
                count: $args['count'] ?? null,
                page: $args['page'] ?? null,
                status: $args['status'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
