<?php

namespace OpenCompany\Integrations\WooCommerce\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WooCommerce\WooCommerceService;

/**
 * Tool: woocommerce_get_product
 *
 * Retrieves details for a single WooCommerce product by ID.
 */
class WooCommerceGetProduct implements Tool
{
    public function __construct(
        private WooCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_get_product';
    }

    public function description(): string
    {
        return 'Get full details for a single WooCommerce product by its ID.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The product ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $id = (int) ($args['id'] ?? 0);

            if ($id <= 0) {
                return ToolResult::error('A valid product ID is required.');
            }

            $result = $this->service->getProduct($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
