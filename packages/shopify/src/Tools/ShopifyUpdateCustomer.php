<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Shopify customer.
 */
class ShopifyUpdateCustomer implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_update_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Shopify customer.
        Supports updating first_name, last_name, email, and tags.
        Only provided fields will be updated.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'The Shopify customer ID to update.'],
            'first_name' => ['type' => 'string', 'description' => 'Customer first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Customer last name.'],
            'email' => ['type' => 'string', 'description' => 'Customer email address.'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated list of tags.'],
        ];
    }

    /**
     * Update a customer in Shopify.
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

            $data = [];

            if (isset($args['first_name'])) {
                $data['first_name'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['last_name'] = $args['last_name'];
            }
            if (isset($args['email'])) {
                $data['email'] = $args['email'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }

            $result = $this->service->updateCustomer($id, $data);
            $customer = $result['customer'] ?? $result;

            return ToolResult::success([
                'id' => $customer['id'] ?? null,
                'first_name' => $customer['first_name'] ?? '',
                'last_name' => $customer['last_name'] ?? '',
                'email' => $customer['email'] ?? '',
                'tags' => $customer['tags'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
