<?php

namespace OpenCompany\Integrations\Podia\Tools;

use OpenCompany\Integrations\Podia\PodiaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PodiaListProducts implements Tool
{
    public function __construct(
        private PodiaService $service,
    ) {}

    public function name(): string
    {
        return 'podia_list_products';
    }

    public function description(): string
    {
        return 'List all online courses and digital downloads in your Podia account. Returns product names, IDs, types, and metadata.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podia integration is not configured.');
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
