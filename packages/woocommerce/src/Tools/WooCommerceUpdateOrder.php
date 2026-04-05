<?php

namespace OpenCompany\Integrations\WooCommerce\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WooCommerce\WooCommerceService;

/**
 * Tool: woocommerce_update_order
 *
 * Updates an existing WooCommerce order (e.g. change status, add notes).
 */
class WooCommerceUpdateOrder implements Tool
{
    public function __construct(
        private WooCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_update_order';
    }

    public function description(): string
    {
        return 'Update an existing WooCommerce order. Commonly used to change order status.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id'                => ['type' => 'integer', 'required' => true, 'description' => 'The order ID to update.'],
            'status'            => ['type' => 'string',  'description' => 'New order status: pending, processing, on-hold, completed, cancelled, refunded, failed.'],
            'customer_note'     => ['type' => 'string',  'description' => 'Note added to the order visible to the customer.'],
            'billing'           => ['type' => 'array',   'description' => 'Billing address fields.'],
            'shipping'          => ['type' => 'array',   'description' => 'Shipping address fields.'],
            'line_items'        => ['type' => 'array',   'description' => 'Line items data.'],
            'shipping_lines'    => ['type' => 'array',   'description' => 'Shipping lines data.'],
            'meta_data'         => ['type' => 'array',   'description' => 'Custom meta data.'],
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
                return ToolResult::error('A valid order ID is required.');
            }

            $data = array_filter($args, fn ($v, $k) => $v !== null && $k !== 'id', ARRAY_FILTER_USE_BOTH);

            if (empty($data)) {
                return ToolResult::error('No fields provided to update.');
            }

            $result = $this->service->updateOrder($id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
