<?php

namespace OpenCompany\Integrations\Paystack\Tools;

use OpenCompany\Integrations\Paystack\PaystackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a Paystack transaction by numeric transaction ID.
 *
 * Use PaystackVerifyTransaction when the caller has a transaction reference.
 */
class PaystackGetTransaction implements Tool
{
    /**
     * @param  PaystackService  $service  The Paystack API service.
     */
    public function __construct(
        private PaystackService $service,
    ) {}

    public function name(): string
    {
        return 'paystack_get_transaction';
    }

    public function description(): string
    {
        return 'Get details of a specific Paystack transaction by its numeric ID. Use paystack_verify_transaction when you have a reference.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Numeric transaction ID. Use paystack_verify_transaction for transaction references.'],
        ];
    }

    /**
     * Fetch a transaction by numeric ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paystack integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Transaction ID is required.');
            }

            $result = $this->service->getTransaction($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
