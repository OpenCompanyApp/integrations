<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel a Shopify order.
 */
class ShopifyCancelOrder implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_cancel_order';
    }

    public function description(): string
    {
        return <<<'MD'
        Cancel a Shopify order by its ID.
        Optionally specify a cancellation reason (customer, inventory, fraud, other).
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'The Shopify order ID to cancel.'],
            'reason' => ['type' => 'string', 'description' => 'Cancellation reason: customer, inventory, fraud, or other.'],
        ];
    }

    /**
     * Cancel an order in Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Order ID is required.');
            }

            $params = [];
            if (isset($args['reason'])) {
                $params['reason'] = $args['reason'];
            }

            $result = $this->service->cancelOrder($id, $params);
            $order = $result['order'] ?? $result;

            return ToolResult::success([
                'id' => $order['id'] ?? null,
                'name' => $order['name'] ?? '',
                'cancelled_at' => $order['cancelled_at'] ?? null,
                'cancel_reason' => $order['cancel_reason'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
