<?php

namespace OpenCompany\Integrations\Braintree\Tools;

use OpenCompany\Integrations\Braintree\BraintreeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BraintreeGetCustomer implements Tool
{
    public function __construct(
        private BraintreeService $service,
    ) {}

    public function name(): string
    {
        return 'braintree_get_customer';
    }

    public function description(): string
    {
        return 'Retrieve a single Braintree customer by ID. Returns full customer details including contact info, payment methods, and addresses.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The customer ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braintree integration is not configured. Missing access token or merchant ID.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Customer ID is required.');
            }

            $result = $this->service->getCustomer($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
