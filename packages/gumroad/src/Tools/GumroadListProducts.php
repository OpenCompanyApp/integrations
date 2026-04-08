<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

use OpenCompany\Integrations\Gumroad\GumroadService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GumroadListProducts implements Tool
{
    public function __construct(
        private GumroadService $service,
    ) {}

    public function name(): string
    {
        return 'gumroad_list_products';
    }

    public function description(): string
    {
        return 'List all digital products in your Gumroad account. Returns product names, IDs, prices, and metadata.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gumroad integration is not configured.');
            }

            $result = $this->service->listProducts();

            $products = $result['products'] ?? [];

            return ToolResult::success([
                'products' => $products,
                'totalCount' => count($products),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
