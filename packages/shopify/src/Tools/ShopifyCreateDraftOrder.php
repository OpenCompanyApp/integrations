<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Shopify draft order.
 */
class ShopifyCreateDraftOrder implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_create_draft_order';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a Shopify draft order.
        Supports line_items (array of variant_id + quantity or title + price), customer, and note.
        Draft orders can be later sent as an invoice or completed into an order.
        MD;
    }

    public function parameters(): array
    {
        return [
            'line_items' => ['type' => 'array', 'description' => 'Array of line items with variant_id + quantity, or title + price.'],
            'customer' => ['type' => 'object', 'description' => 'Customer object with id or email.'],
            'note' => ['type' => 'string', 'description' => 'Optional note attached to the draft order.'],
        ];
    }

    /**
     * Create a draft order in Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $data = [];

            if (isset($args['line_items']) && is_array($args['line_items'])) {
                $data['line_items'] = $args['line_items'];
            }
            if (isset($args['customer']) && is_array($args['customer'])) {
                $data['customer'] = $args['customer'];
            }
            if (isset($args['note'])) {
                $data['note'] = $args['note'];
            }

            $result = $this->service->createDraftOrder($data);
            $draft = $result['draft_order'] ?? $result;

            return ToolResult::success([
                'id' => $draft['id'] ?? null,
                'name' => $draft['name'] ?? '',
                'status' => $draft['status'] ?? '',
                'total_price' => $draft['total_price'] ?? '',
                'currency' => $draft['currency'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
