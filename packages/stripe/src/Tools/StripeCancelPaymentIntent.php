<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel a Stripe payment intent.
 *
 * Can only cancel payment intents in certain statuses (requires_payment_method, requires_capture, requires_confirmation).
 */
class StripeCancelPaymentIntent implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_cancel_payment_intent';
    }

    public function description(): string
    {
        return <<<'MD'
        Cancel a Stripe payment intent.
        Can only cancel payment intents that are in "requires_payment_method", "requires_capture", or "requires_confirmation" status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Payment intent ID (e.g., "pi_...").'],
            'cancellation_reason' => ['type' => 'string', 'description' => 'Reason for cancellation: "abandoned", "automatic", "duplicate", or "requested_by_customer".'],
        ];
    }

    /**
     * Cancel a Stripe payment intent by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, cancellation_reason)
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

            if (isset($args['cancellation_reason'])) {
                $data['cancellation_reason'] = $args['cancellation_reason'];
            }

            $result = $this->service->cancelPaymentIntent($id, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'amount' => $result['amount'] ?? 0,
                'currency' => $result['currency'] ?? '',
                'status' => $result['status'] ?? '',
                'cancellation_reason' => $result['cancellation_reason'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
