<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Confirm a Stripe payment intent.
 *
 * Provide a payment method and optional return URL to confirm the payment.
 */
class StripeConfirmPaymentIntent implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_confirm_payment_intent';
    }

    public function description(): string
    {
        return <<<'MD'
        Confirm a Stripe payment intent.
        Provide a payment method and optional return URL to confirm the payment.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Payment intent ID (e.g., "pi_...").'],
            'payment_method' => ['type' => 'string', 'description' => 'Payment method ID (e.g., "pm_...") or token.'],
            'return_url' => ['type' => 'string', 'description' => 'URL to redirect after payment completion.'],
        ];
    }

    /**
     * Confirm a Stripe payment intent with a payment method.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, payment_method, return_url)
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

            if (isset($args['payment_method'])) {
                $data['payment_method'] = $args['payment_method'];
            }
            if (isset($args['return_url'])) {
                $data['return_url'] = $args['return_url'];
            }

            $result = $this->service->confirmPaymentIntent($id, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'amount' => $result['amount'] ?? 0,
                'currency' => $result['currency'] ?? '',
                'status' => $result['status'] ?? '',
                'next_action' => $result['next_action'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
