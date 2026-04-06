<?php

namespace OpenCompany\Integrations\Canva\Tools;

use OpenCompany\Integrations\Canva\CanvaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CanvaListDesigns implements Tool
{
    public function __construct(
        private CanvaService $service,
    ) {}

    public function name(): string
    {
        return 'canva_list_designs';
    }

    public function description(): string
    {
        return 'List designs the user has access to in Canva. Supports filtering by search query and design type. Returns design titles and IDs that can be used with canva_get_design.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of designs to return (1–100, default 50).'],
            'continuation' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the continuation token from a previous response to get the next page.'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter designs by title.'],
            'type' => ['type' => 'string', 'description' => 'Filter by design type (e.g., "presentation", "poster", "social_media", "video", "document").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Canva integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $result = $this->service->listDesigns(
                limit: $limit,
                continuation: $args['continuation'] ?? null,
                query: $args['query'] ?? null,
                type: $args['type'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
