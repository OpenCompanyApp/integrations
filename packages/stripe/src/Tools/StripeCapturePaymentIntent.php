<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Capture a Stripe payment intent that was created with capture_method="manual".
 *
 * Optionally specify an amount_to_capture to capture less than the original amount.
 */
class StripeCapturePaymentIntent implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_capture_payment_intent';
    }

    public function description(): string
    {
        return <<<'MD'
        Capture a Stripe payment intent that was created with capture_method="manual".
        Optionally specify an amount_to_capture to capture less than the original amount.
        Amounts are in cents.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Payment intent ID (e.g., "pi_...").'],
            'amount_to_capture' => ['type' => 'integer', 'description' => 'Amount to capture in cents. Defaults to full amount if omitted.'],
        ];
    }

    /**
     * Capture a previously created payment intent with manual capture.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, amount_to_capture)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $data = [];

            if (isset($args['amount_to_capture'])) {
                $data['amount_to_capture'] = (int) $args['amount_to_capture'];
            }

            $result = $this->service->capturePaymentIntent($id, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'amount' => $result['amount'] ?? 0,
                'amount_capturable' => $result['amount_capturable'] ?? 0,
                'amount_received' => $result['amount_received'] ?? 0,
                'currency' => $result['currency'] ?? '',
                'status' => $result['status'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
