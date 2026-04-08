<?php

namespace OpenCompany\Integrations\Podia\Tools;

use OpenCompany\Integrations\Podia\PodiaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PodiaGetCustomer implements Tool
{
    public function __construct(
        private PodiaService $service,
    ) {}

    public function name(): string
    {
        return 'podia_get_customer';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Podia customer by their ID. Returns customer status, email, and purchase details.';
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the customer to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podia integration is not configured.');
            }

            if (empty($args['customer_id'])) {
                return ToolResult::error('customer_id is required.');
            }

            $result = $this->service->getCustomer($args['customer_id']);

            $customer = $result['customer'] ?? $result;

            return ToolResult::success($customer);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
