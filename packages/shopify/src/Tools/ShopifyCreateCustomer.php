<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Shopify customer.
 */
class ShopifyCreateCustomer implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_create_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new Shopify customer.
        Supports first_name, last_name, email, phone, and tags.
        Returns the created customer object with ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'Customer first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Customer last name.'],
            'email' => ['type' => 'string', 'description' => 'Customer email address.'],
            'phone' => ['type' => 'string', 'description' => 'Customer phone number.'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated list of tags.'],
        ];
    }

    /**
     * Create a new customer in Shopify.
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

            if (isset($args['first_name'])) {
                $data['first_name'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['last_name'] = $args['last_name'];
            }
            if (isset($args['email'])) {
                $data['email'] = $args['email'];
            }
            if (isset($args['phone'])) {
                $data['phone'] = $args['phone'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }

            $result = $this->service->createCustomer($data);
            $customer = $result['customer'] ?? $result;

            return ToolResult::success([
                'id' => $customer['id'] ?? null,
                'first_name' => $customer['first_name'] ?? '',
                'last_name' => $customer['last_name'] ?? '',
                'email' => $customer['email'] ?? '',
                'phone' => $customer['phone'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
