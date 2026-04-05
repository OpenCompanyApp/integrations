<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new customer in the BigCommerce store.
 *
 * Requires at minimum first_name, last_name, and email.
 */
class BigCommerceCreateCustomer implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_create_customer';
    }

    public function description(): string
    {
        return 'Create a new customer in the BigCommerce store. Requires first name, last name, and email.';
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'required' => true, 'description' => 'Customer first name.'],
            'last_name' => ['type' => 'string', 'required' => true, 'description' => 'Customer last name.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Customer email address.'],
            'phone' => ['type' => 'string', 'description' => 'Phone number.'],
            'company' => ['type' => 'string', 'description' => 'Company name.'],
            'authentication' => ['type' => 'object', 'description' => 'Authentication settings with "force_password_reset" boolean.'],
            'customer_group_id' => ['type' => 'integer', 'description' => 'Customer group ID to assign.'],
            'addresses' => ['type' => 'array', 'description' => 'Array of address objects (address1, city, state_or_province, postal_code, country_code).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BigCommerce integration is not configured.');
            }

            $data = [
                'first_name' => $args['first_name'],
                'last_name' => $args['last_name'],
                'email' => $args['email'],
            ];

            $optionalFields = [
                'phone', 'company', 'authentication', 'customer_group_id', 'addresses',
            ];

            foreach ($optionalFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            $result = $this->service->createCustomer($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
