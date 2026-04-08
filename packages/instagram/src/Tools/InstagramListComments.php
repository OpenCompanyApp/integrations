<?php

namespace OpenCompany\Integrations\Instagram\Tools;

use OpenCompany\Integrations\Instagram\InstagramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List comments on an Instagram media item.
 *
 * Returns a paginated list of comments with IDs, text,
 * timestamps, usernames, and like counts.
 */
class InstagramListComments implements Tool
{
    public function __construct(
        private InstagramService $service,
    ) {}

    public function name(): string
    {
        return 'instagram_list_comments';
    }

    public function description(): string
    {
        return 'List comments on a specific Instagram media item. Returns comment IDs, text, timestamps, usernames, and like counts. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'mediaId' => ['type' => 'string', 'required' => true, 'description' => 'The media ID to list comments for.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of comments to return per page.'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor — return comments after this cursor.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instagram integration is not configured.');
            }

            if (empty($args['mediaId'])) {
                return ToolResult::error('mediaId is required.');
            }

            $result = $this->service->listComments(
                mediaId: $args['mediaId'],
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                after: $args['after'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
