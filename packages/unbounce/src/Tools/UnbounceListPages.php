<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\Integrations\Unbounce\UnbounceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Unbounce landing pages.
 */
class UnbounceListPages implements Tool
{
    /**
     * @param  UnbounceService  $service  Unbounce API client.
     */
    public function __construct(
        private UnbounceService $service,
    ) {}

    public function name(): string
    {
        return 'unbounce_list_pages';
    }

    public function description(): string
    {
        return 'List landing pages in Unbounce. Returns page IDs, names, URLs, and metadata. Use this to discover available pages before querying leads or page details.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of pages to return (default: 50, max: 1000).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'sort' => ['type' => 'string', 'description' => 'Sort order. Prefix with "-" for descending (e.g., "created_at", "-created_at").'],
        ];
    }

    /**
     * List pages.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Unbounce integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $sort = $args['sort'] ?? null;

            $result = $this->service->listPages($limit, $offset, $sort);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
