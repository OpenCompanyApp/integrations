<?php

namespace OpenCompany\Integrations\WooCommerce\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WooCommerce\WooCommerceService;

/**
 * Tool: woocommerce_delete_product
 *
 * Deletes (trashes or permanently removes) a product from WooCommerce.
 */
class WooCommerceDeleteProduct implements Tool
{
    public function __construct(
        private WooCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_delete_product';
    }

    public function description(): string
    {
        return 'Delete a product from the WooCommerce store. By default moves to trash; set force to true for permanent deletion.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id'    => ['type' => 'integer', 'required' => true, 'description' => 'The product ID to delete.'],
            'force' => ['type' => 'boolean', 'description' => 'Set to true to permanently delete instead of moving to trash.'],
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

            $params = [];
            if (! empty($args['force'])) {
                $params['force'] = true;
            }

            $result = $this->service->deleteProduct($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
