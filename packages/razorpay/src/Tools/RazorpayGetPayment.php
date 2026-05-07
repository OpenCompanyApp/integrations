<?php

namespace OpenCompany\Integrations\Razorpay\Tools;

use OpenCompany\Integrations\Razorpay\RazorpayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single payment by ID from Razorpay.
 *
 * Fetches full payment details including amount, currency, status,
 * method, and associated order/refund information.
 */
class RazorpayGetPayment implements Tool
{
    /**
     * Create a new RazorpayGetPayment tool instance.
     */
    public function __construct(
        private RazorpayService $service,
    ) {}

    /**
     * The tool name identifier.
     */
    public function name(): string
    {
        return 'razorpay_get_payment';
    }

    /**
     * A description of what this tool does, used by the AI agent.
     */
    public function description(): string
    {
        return 'Get details of a specific Razorpay payment by its ID. Returns full payment information including amount, status, method, and metadata.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'payment_id' => ['type' => 'string', 'required' => true, 'description' => 'The Razorpay payment ID (e.g., "pay_1234567890").'],
        ];
    }

    /**
     * Execute the tool and return the payment details.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Razorpay integration is not configured.');
            }

            if (empty($args['payment_id'])) {
                return ToolResult::error('Payment ID is required.');
            }

            $result = $this->service->getPayment($args['payment_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
