<?php

namespace OpenCompany\Integrations\Sellfy\Tools;

use OpenCompany\Integrations\Sellfy\SellfyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SellfyCreateProduct implements Tool
{
    public function __construct(
        private SellfyService $service,
    ) {}

    public function name(): string
    {
        return 'sellfy_create_product';
    }

    public function description(): string
    {
        return 'Create a new product in your Sellfy store. Supports digital products, subscriptions, and physical goods.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The product name.'],
            'price' => ['type' => 'number', 'required' => true, 'description' => 'The product price.'],
            'type' => ['type' => 'string', 'description' => 'Product type (e.g., "digital", "subscription", "physical"). Default: "digital".'],
            'description' => ['type' => 'string', 'description' => 'Product description.'],
            'currency' => ['type' => 'string', 'description' => 'Currency code (e.g., "USD", "EUR"). Default: store default.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sellfy integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Product name is required.');
            }

            if (!isset($args['price'])) {
                return ToolResult::error('Product price is required.');
            }

            $data = array_filter([
                'name' => $args['name'],
                'price' => $args['price'],
                'type' => $args['type'] ?? null,
                'description' => $args['description'] ?? null,
                'currency' => $args['currency'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->createProduct($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
