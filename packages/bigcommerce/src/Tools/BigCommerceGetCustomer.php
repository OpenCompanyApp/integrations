<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single customer from the BigCommerce store by ID.
 */
class BigCommerceGetCustomer implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_get_customer';
    }

    public function description(): string
    {
        return 'Get a single customer from the BigCommerce store by their ID. Returns full customer details.';
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
                return ToolResult::error('BigCommerce integration is not configured.');
            }

            $result = $this->service->getCustomer((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
