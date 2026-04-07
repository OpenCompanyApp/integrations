<?php

namespace OpenCompany\Integrations\KoFi\Tools;

use OpenCompany\Integrations\KoFi\KoFiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KoFiListShopItems implements Tool
{
    public function __construct(
        private KoFiService $service,
    ) {}

    public function name(): string
    {
        return 'ko-fi_list_shop_items';
    }

    public function description(): string
    {
        return 'List all items in your Ko-fi shop. Returns item names, descriptions, prices, and availability.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Number of results per page (default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ko-fi integration is not configured.');
            }

            $params = array_filter([
                'page' => $args['page'] ?? null,
                'limit' => $args['limit'] ?? null,
            ], fn($v) => $v !== null);

            $result = $this->service->listShopItems($params);

            $items = $result['items'] ?? $result['data'] ?? $result['shop_items'] ?? [];

            return ToolResult::success([
                'items' => $items,
                'totalCount' => count($items),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
