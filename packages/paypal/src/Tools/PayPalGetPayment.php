<?php

namespace OpenCompany\Integrations\PayPal\Tools;

use OpenCompany\Integrations\PayPal\PayPalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a single PayPal payment by ID.
 *
 * Returns full payment details including state, amount,
 * payer information, and transaction history.
 */
class PayPalGetPayment implements Tool
{
    /**
     * Create a new PayPalGetPayment tool instance.
     *
     * @param  PayPalService  $service  The PayPal API service.
     */
    public function __construct(
        private PayPalService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'paypal_get_payment';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Get details of a specific PayPal payment by its payment ID. Returns full payment information including state, amount, payer details, and transactions.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'payment_id' => ['type' => 'string', 'required' => true, 'description' => 'The PayPal payment ID (e.g., "PAY-1AB23456CD789012EFGHIJKL").'],
        ];
    }

    /**
     * Execute the get payment request.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PayPal integration is not configured.');
            }

            if (empty($args['payment_id'])) {
                return ToolResult::error('payment_id is required.');
            }

            $result = $this->service->getPayment($args['payment_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
