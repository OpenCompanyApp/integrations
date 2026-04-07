<?php

namespace OpenCompany\Integrations\Instagram\Tools;

use OpenCompany\Integrations\Instagram\InstagramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List media published by the authenticated Instagram user.
 *
 * Returns a paginated list of media items with IDs, captions,
 * media types, URLs, timestamps, and other metadata.
 */
class InstagramListMedia implements Tool
{
    public function __construct(
        private InstagramService $service,
    ) {}

    public function name(): string
    {
        return 'instagram_list_media';
    }

    public function description(): string
    {
        return 'List media published by the authenticated Instagram user. Returns media IDs, captions, types, URLs, and timestamps. Supports cursor-based pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of media items to return per page.'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor — return items after this cursor.'],
            'before' => ['type' => 'string', 'description' => 'Pagination cursor — return items before this cursor.'],
            'fields' => ['type' => 'string', 'description' => 'Comma-separated list of fields to return (e.g. "id,caption,media_type,media_url,permalink,timestamp,username").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instagram integration is not configured.');
            }

            $result = $this->service->listMedia(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                after: $args['after'] ?? null,
                before: $args['before'] ?? null,
                fields: $args['fields'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
