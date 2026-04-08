<?php

namespace OpenCompany\Integrations\Paystack\Tools;

use OpenCompany\Integrations\Paystack\PaystackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaystackGetTransaction implements Tool
{
    public function __construct(
        private PaystackService $service,
    ) {}

    public function name(): string
    {
        return 'paystack_get_transaction';
    }

    public function description(): string
    {
        return 'Get details of a specific Paystack transaction by its ID or reference.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Transaction ID or reference.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paystack integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Transaction ID or reference is required.');
            }

            $result = $this->service->getTransaction($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
