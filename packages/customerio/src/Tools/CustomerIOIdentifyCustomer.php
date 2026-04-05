<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

use OpenCompany\Integrations\CustomerIO\CustomerIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CustomerIOIdentifyCustomer implements Tool
{
    public function __construct(
        private CustomerIOService $service,
    ) {}

    public function name(): string
    {
        return 'customerio_identify_customer';
    }

    public function description(): string
    {
        return 'Create or update a customer profile in Customer.io. Use this to add new customers or update existing customer attributes like email, name, and custom properties.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Unique identifier for the customer (e.g., user ID, email, or external ID).'],
            'email' => ['type' => 'string', 'description' => 'Customer email address.'],
            'name' => ['type' => 'string', 'description' => 'Customer full name.'],
            'attributes' => ['type' => 'object', 'description' => 'Additional custom attributes to set on the customer profile (e.g., {"plan": "premium", "company": "Acme"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Customer.io integration is not configured.');
            }

            $id = $args['id'];
            $attributes = [];

            if (isset($args['email'])) {
                $attributes['email'] = $args['email'];
            }

            if (isset($args['name'])) {
                $attributes['name'] = $args['name'];
            }

            if (isset($args['attributes']) && is_array($args['attributes'])) {
                $attributes = array_merge($attributes, $args['attributes']);
            }

            if (empty($attributes)) {
                return ToolResult::error('At least one attribute (email, name, or attributes) must be provided.');
            }

            $result = $this->service->identifyCustomer($id, $attributes);

            return ToolResult::success(array_merge([
                'message' => "Customer '{$id}' has been identified successfully.",
                'customer_id' => $id,
            ], $result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
