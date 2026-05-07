<?php

namespace OpenCompany\Integrations\Paystack\Tools;

use OpenCompany\Integrations\Paystack\PaystackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Initialize a Paystack transaction.
 *
 * Creates a payment authorization URL for a customer checkout flow.
 */
class PaystackInitializeTransaction implements Tool
{
    /**
     * @param  PaystackService  $service  The Paystack API service.
     */
    public function __construct(
        private PaystackService $service,
    ) {}

    public function name(): string
    {
        return 'paystack_initialize_transaction';
    }

    public function description(): string
    {
        return 'Initialize a new payment transaction on Paystack. Returns an authorization URL for the customer to complete payment.';
    }

    public function parameters(): array
    {
        return [
            'amount' => ['type' => 'integer', 'required' => true, 'description' => 'Amount in kobo (e.g., 50000 for ₦500.00).'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Customer email address.'],
            'reference' => ['type' => 'string', 'description' => 'Unique transaction reference. If not provided, Paystack generates one.'],
            'callback_url' => ['type' => 'string', 'description' => 'URL to redirect customer to after payment.'],
        ];
    }

    /**
     * Initialize a transaction with amount and customer email.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paystack integration is not configured.');
            }

            if (empty($args['amount'])) {
                return ToolResult::error('Amount is required.');
            }
            if (empty($args['email'])) {
                return ToolResult::error('Email is required.');
            }

            $data = [
                'amount' => (int) $args['amount'],
                'email' => $args['email'],
            ];

            if (isset($args['reference'])) {
                $data['reference'] = $args['reference'];
            }
            if (isset($args['callback_url'])) {
                $data['callback_url'] = $args['callback_url'];
            }

            $result = $this->service->initializeTransaction($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
