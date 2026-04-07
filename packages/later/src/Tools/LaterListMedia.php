<?php

namespace OpenCompany\Integrations\Later\Tools;

use OpenCompany\Integrations\Later\LaterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List media items in the Later media library.
 *
 * Returns media assets uploaded to Later, including images and videos,
 * with optional filtering by type.
 */
class LaterListMedia implements Tool
{
    public function __construct(
        private LaterService $service,
    ) {}

    public function name(): string
    {
        return 'later_list_media';
    }

    public function description(): string
    {
        return 'List media items in the Later media library. Returns media IDs, URLs, types, and metadata. Optionally filter by media type.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of media items to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'type' => ['type' => 'string', 'description' => 'Filter by media type: "image" or "video".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Later integration is not configured.');
            }

            $result = $this->service->listMedia(
                limit: $args['limit'] ?? null,
                page: $args['page'] ?? null,
                type: $args['type'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
