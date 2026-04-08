<?php

namespace OpenCompany\Integrations\Razorpay\Tools;

use OpenCompany\Integrations\Razorpay\RazorpayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new payment order in Razorpay.
 *
 * Creates an order with the specified amount, currency, and receipt.
 * The amount is in the smallest currency unit (e.g., paise for INR,
 * so ₹100.00 = 10000).
 */
class RazorpayCreateOrder implements Tool
{
    /**
     * Create a new RazorpayCreateOrder tool instance.
     */
    public function __construct(
        private RazorpayService $service,
    ) {}

    /**
     * The tool name identifier.
     */
    public function name(): string
    {
        return 'razorpay_create_order';
    }

    /**
     * A description of what this tool does, used by the AI agent.
     */
    public function description(): string
    {
        return 'Create a new payment order in Razorpay. Specify the amount (in smallest currency unit, e.g., paise for INR), currency, and an optional receipt identifier.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'amount' => ['type' => 'integer', 'required' => true, 'description' => 'Amount in smallest currency unit (e.g., 10000 for ₹100.00 in INR).'],
            'currency' => ['type' => 'string', 'description' => 'Three-letter currency code (default: "INR").'],
            'receipt' => ['type' => 'string', 'description' => 'Your internal receipt identifier (max 40 characters).'],
            'notes' => ['type' => 'object', 'description' => 'Key-value notes to attach to the order.'],
        ];
    }

    /**
     * Execute the tool and create the order.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Razorpay integration is not configured.');
            }

            $amount = (int) $args['amount'];
            $currency = $args['currency'] ?? 'INR';
            $receipt = $args['receipt'] ?? '';
            $extra = [];

            if (isset($args['notes']) && is_array($args['notes'])) {
                $extra['notes'] = $args['notes'];
            }

            $result = $this->service->createOrder($amount, $currency, $receipt, $extra);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
