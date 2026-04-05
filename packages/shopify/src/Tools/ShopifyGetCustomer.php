<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Shopify customer by ID.
 */
class ShopifyGetCustomer implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_get_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single Shopify customer by their ID.
        Returns the full customer object including addresses and orders count.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'The Shopify customer ID.'],
        ];
    }

    /**
     * Get a customer from Shopify by ID.
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
                return ToolResult::error('Customer ID is required.');
            }

            $result = $this->service->getCustomer($id);
            $customer = $result['customer'] ?? $result;

            return ToolResult::success($customer);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
