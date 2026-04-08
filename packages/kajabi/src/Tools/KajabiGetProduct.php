<?php

namespace OpenCompany\Integrations\Kajabi\Tools;

use OpenCompany\Integrations\Kajabi\KajabiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KajabiGetProduct implements Tool
{
    public function __construct(
        private KajabiService $service,
    ) {}

    public function name(): string
    {
        return 'kajabi_get_product';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Kajabi product by its ID. Returns full product data including description, pricing, and content details.';
    }

    public function parameters(): array
    {
        return [
            'product_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the product to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kajabi integration is not configured.');
            }

            if (empty($args['product_id'])) {
                return ToolResult::error('product_id is required.');
            }

            $result = $this->service->getProduct($args['product_id']);

            $product = $result['product'] ?? $result['data'] ?? $result;

            return ToolResult::success($product);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
