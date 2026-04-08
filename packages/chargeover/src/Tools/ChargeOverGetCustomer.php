<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChargeOverGetCustomer implements Tool
{
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_get_customer';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific ChargeOver customer by ID, including contact details, billing address, account balance, and payment methods.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The customer ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Customer ID is required.');
            }

            $result = $this->service->getCustomer((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
