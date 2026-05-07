<?php

namespace OpenCompany\Integrations\Razorpay\Tools;

use OpenCompany\Integrations\Razorpay\RazorpayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single order by ID from Razorpay.
 *
 * Fetches full order details including amount, currency, status,
 * receipt, and associated payment information.
 */
class RazorpayGetOrder implements Tool
{
    /**
     * Create a new RazorpayGetOrder tool instance.
     */
    public function __construct(
        private RazorpayService $service,
    ) {}

    /**
     * The tool name identifier.
     */
    public function name(): string
    {
        return 'razorpay_get_order';
    }

    /**
     * A description of what this tool does, used by the AI agent.
     */
    public function description(): string
    {
        return 'Get details of a specific Razorpay order by its ID. Returns full order information including amount, status, and payments.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'order_id' => ['type' => 'string', 'required' => true, 'description' => 'The Razorpay order ID (e.g., "order_1234567890").'],
        ];
    }

    /**
     * Execute the tool and return the order details.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Razorpay integration is not configured.');
            }

            if (empty($args['order_id'])) {
                return ToolResult::error('Order ID is required.');
            }

            $result = $this->service->getOrder($args['order_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
