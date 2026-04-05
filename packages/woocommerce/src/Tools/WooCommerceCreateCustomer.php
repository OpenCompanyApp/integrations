<?php

namespace OpenCompany\Integrations\WooCommerce\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WooCommerce\WooCommerceService;

/**
 * Tool: woocommerce_create_customer
 *
 * Creates a new customer in the WooCommerce store.
 */
class WooCommerceCreateCustomer implements Tool
{
    public function __construct(
        private WooCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_create_customer';
    }

    public function description(): string
    {
        return 'Create a new customer in the WooCommerce store. Provide at least an email address.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'email'      => ['type' => 'string', 'required' => true,  'description' => 'Customer email address.'],
            'first_name' => ['type' => 'string', 'description' => 'First name.'],
            'last_name'  => ['type' => 'string', 'description' => 'Last name.'],
            'username'   => ['type' => 'string', 'description' => 'Login username (auto-generated if omitted).'],
            'password'   => ['type' => 'string', 'description' => 'Login password (auto-generated if omitted).'],
            'billing'    => ['type' => 'array',  'description' => 'Billing address fields.'],
            'shipping'   => ['type' => 'array',  'description' => 'Shipping address fields.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('Customer email is required.');
            }

            $data = array_filter($args, fn ($v, $k) => $v !== null && $k !== '', ARRAY_FILTER_USE_BOTH);

            $result = $this->service->createCustomer($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
