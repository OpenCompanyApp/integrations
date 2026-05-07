<?php

namespace OpenCompany\Integrations\PayPal\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\PayPal\PayPalService;

/**
 * Capture a previously approved PayPal checkout order.
 *
 * Sends an Orders v2 capture request and returns the capture status,
 * payer details, purchase units, and related PayPal links.
 */
class PayPalCaptureOrder implements Tool
{
    /**
     * Create a new PayPalCaptureOrder tool instance.
     *
     * @param  PayPalService  $service  The PayPal API service.
     */
    public function __construct(
        private PayPalService $service,
    ) {}

    public function name(): string
    {
        return 'paypal_capture_order';
    }

    public function description(): string
    {
        return 'Capture a previously approved PayPal checkout order by order ID. Use after the payer approves an order created with intent CAPTURE.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'order_id' => ['type' => 'string', 'required' => true, 'description' => 'The approved PayPal checkout order ID.'],
            'payment_source' => ['type' => 'array', 'description' => 'Optional payment source data to include in the capture request.'],
        ];
    }

    /**
     * Execute the capture order request.
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

            $body = [];
            if (isset($args['payment_source'])) {
                $body['payment_source'] = $args['payment_source'];
            }

            return ToolResult::success($this->service->captureOrder($args['order_id'], $body));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
