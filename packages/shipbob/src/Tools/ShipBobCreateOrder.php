<?php

namespace OpenCompany\Integrations\ShipBob\Tools;

use OpenCompany\Integrations\ShipBob\ShipBobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new fulfillment order in ShipBob.
 *
 * Submit an order with product line items, a receiving note for the fulfillment
 * center, and an optional shipping method. ShipBob will process and fulfill the order.
 */
class ShipBobCreateOrder implements Tool
{
    public function __construct(
        private ShipBobService $service,
    ) {}

    public function name(): string
    {
        return 'shipbob_create_order';
    }

    public function description(): string
    {
        return 'Create a new fulfillment order in ShipBob. Provide product line items, a receiving note, and an optional shipping method.';
    }

    public function parameters(): array
    {
        return [
            'receiving_note' => ['type' => 'string', 'required' => true, 'description' => 'A note for the fulfillment center (e.g. "Handle with care" or "Priority shipment").'],
            'products' => ['type' => 'array', 'required' => true, 'description' => 'List of product line items. Each item should include product reference/ID and quantity. Example: [{"id": 123, "quantity": 2}]'],
            'shipping_method' => ['type' => 'string', 'description' => 'Desired shipping method (e.g. "ground", "expedited", "overnight"). Optional — ShipBob selects the best method if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ShipBob integration is not configured.');
            }

            if (empty($args['receiving_note'])) {
                return ToolResult::error('The "receiving_note" parameter is required.');
            }

            if (empty($args['products']) || !is_array($args['products'])) {
                return ToolResult::error('The "products" parameter is required and must be an array of line items.');
            }

            $receivingNote = $args['receiving_note'];
            $products = $args['products'];
            $shippingMethod = $args['shipping_method'] ?? null;

            $result = $this->service->createOrder($receivingNote, $products, $shippingMethod);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
