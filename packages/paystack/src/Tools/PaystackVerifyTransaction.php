<?php

namespace OpenCompany\Integrations\Paystack\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Paystack\PaystackService;

/**
 * Verify a Paystack transaction by reference.
 *
 * Calls Paystack's verify endpoint to confirm the final transaction status
 * after checkout or webhook processing.
 */
class PaystackVerifyTransaction implements Tool
{
    /**
     * @param  PaystackService  $service  The Paystack API service.
     */
    public function __construct(
        private PaystackService $service,
    ) {}

    public function name(): string
    {
        return 'paystack_verify_transaction';
    }

    public function description(): string
    {
        return 'Verify a Paystack transaction by reference. Use this after checkout redirects or webhook delivery to confirm final payment status.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'reference' => ['type' => 'string', 'required' => true, 'description' => 'The transaction reference returned by Paystack.'],
        ];
    }

    /**
     * Execute the verify transaction request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paystack integration is not configured.');
            }

            if (empty($args['reference'])) {
                return ToolResult::error('Transaction reference is required.');
            }

            return ToolResult::success($this->service->verifyTransaction($args['reference']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
