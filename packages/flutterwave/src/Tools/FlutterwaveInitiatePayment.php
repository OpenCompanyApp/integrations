<?php

namespace OpenCompany\Integrations\Flutterwave\Tools;

use OpenCompany\Integrations\Flutterwave\FlutterwaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FlutterwaveInitiatePayment implements Tool
{
    /**
     * Create a new FlutterwaveInitiatePayment tool instance.
     *
     * @param  FlutterwaveService  $service  The Flutterwave service used to make API calls.
     */
    public function __construct(
        private FlutterwaveService $service,
    ) {}

    /**
     * The unique tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'flutterwave_initiate_payment';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Initiate a new payment on Flutterwave. Requires a transaction reference, amount, currency, and customer details.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'tx_ref' => ['type' => 'string', 'description' => 'Your unique transaction reference (e.g. "txn-001").', 'required' => true],
            'amount' => ['type' => 'number', 'description' => 'Payment amount (e.g. 5000).', 'required' => true],
            'currency' => ['type' => 'string', 'description' => 'Three-letter currency code (e.g. "NGN", "USD", "KES").', 'required' => true],
            'customer' => ['type' => 'object', 'description' => 'Customer object with at least an "email" field. May also include "name" and "phonenumber".', 'required' => true],
            'redirect_url' => ['type' => 'string', 'description' => 'URL to redirect the customer after payment completion.'],
        ];
    }

    /**
     * Execute the tool: initiate a payment on Flutterwave.
     *
     * @param  array  $args  The tool arguments (tx_ref, amount, currency, customer required).
     * @return ToolResult The result containing the payment initiation response or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Flutterwave integration is not configured.');
            }

            if (empty($args['tx_ref'])) {
                return ToolResult::error('The "tx_ref" parameter is required.');
            }

            if (empty($args['amount'])) {
                return ToolResult::error('The "amount" parameter is required.');
            }

            if (empty($args['currency'])) {
                return ToolResult::error('The "currency" parameter is required.');
            }

            if (empty($args['customer']) || !is_array($args['customer'])) {
                return ToolResult::error('The "customer" parameter is required and must be an object with at least an "email" field.');
            }

            $data = [
                'tx_ref' => $args['tx_ref'],
                'amount' => $args['amount'],
                'currency' => $args['currency'],
                'customer' => $args['customer'],
            ];

            if (isset($args['redirect_url'])) {
                $data['redirect_url'] = $args['redirect_url'];
            }

            $result = $this->service->initiatePayment($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
