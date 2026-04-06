<?php

namespace OpenCompany\Integrations\Paystack\Tools;

use OpenCompany\Integrations\Paystack\PaystackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaystackCreateCustomer implements Tool
{
    public function __construct(
        private PaystackService $service,
    ) {}

    public function name(): string
    {
        return 'paystack_create_customer';
    }

    public function description(): string
    {
        return 'Create a new customer on your Paystack integration.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Customer email address.'],
            'first_name' => ['type' => 'string', 'description' => 'Customer first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Customer last name.'],
            'phone' => ['type' => 'string', 'description' => 'Customer phone number.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paystack integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('Email is required.');
            }

            $data = [
                'email' => $args['email'],
            ];

            if (isset($args['first_name'])) {
                $data['first_name'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['last_name'] = $args['last_name'];
            }
            if (isset($args['phone'])) {
                $data['phone'] = $args['phone'];
            }

            $result = $this->service->createCustomer($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
