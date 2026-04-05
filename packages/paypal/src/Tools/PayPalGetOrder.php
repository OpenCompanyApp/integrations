<?php

namespace OpenCompany\Integrations\PayPal\Tools;

use OpenCompany\Integrations\PayPal\PayPalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a single PayPal checkout order by ID.
 *
 * Returns full order details including status, payer information,
 * purchase units, and payment summary.
 */
class PayPalGetOrder implements Tool
{
    /**
     * Create a new PayPalGetOrder tool instance.
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
        return 'paypal_get_order';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Get details of a specific PayPal checkout order by its order ID. Returns full order information including status, payer details, and line items.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'order_id' => ['type' => 'string', 'required' => true, 'description' => 'The PayPal order ID (e.g., "5O190127TN364715T").'],
        ];
    }

    /**
     * Execute the get order request.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PayPal integration is not configured.');
            }

            if (empty($args['order_id'])) {
                return ToolResult::error('order_id is required.');
            }

            $result = $this->service->getOrder($args['order_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
