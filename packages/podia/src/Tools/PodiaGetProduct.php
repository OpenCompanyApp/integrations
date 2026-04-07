<?php

namespace OpenCompany\Integrations\Podia\Tools;

use OpenCompany\Integrations\Podia\PodiaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PodiaGetProduct implements Tool
{
    public function __construct(
        private PodiaService $service,
    ) {}

    public function name(): string
    {
        return 'podia_get_product';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Podia product by its ID. Returns full product data including description, price, type (course or download), and purchase URL.';
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
                return ToolResult::error('Podia integration is not configured.');
            }

            if (empty($args['product_id'])) {
                return ToolResult::error('product_id is required.');
            }

            $result = $this->service->getProduct($args['product_id']);

            $product = $result['product'] ?? $result;

            return ToolResult::success($product);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
