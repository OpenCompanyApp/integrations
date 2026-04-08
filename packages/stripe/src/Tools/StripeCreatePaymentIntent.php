<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Stripe payment intent.
 *
 * Amounts are in cents. Supports automatic payment methods, manual capture, and metadata.
 */
class StripeCreatePaymentIntent implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_create_payment_intent';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a Stripe payment intent.
        Amounts are in cents (e.g., $10.00 = 1000).
        Supports automatic payment methods, manual capture, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'amount' => ['type' => 'integer', 'required' => true, 'description' => 'Amount in cents (e.g., 1000 = $10.00).'],
            'currency' => ['type' => 'string', 'required' => true, 'description' => 'Three-letter currency code (e.g., "usd", "eur").'],
            'customer' => ['type' => 'string', 'description' => 'Stripe customer ID to associate with this payment.'],
            'description' => ['type' => 'string', 'description' => 'Description for this payment.'],
            'metadata' => ['type' => 'object', 'description' => 'Key-value pairs for additional metadata.'],
            'capture_method' => ['type' => 'string', 'description' => 'Capture method: "automatic" (default) or "manual".'],
            'automatic_payment_methods_enabled' => ['type' => 'boolean', 'description' => 'Enable automatic payment methods. Default: true.'],
        ];
    }

    /**
     * Create a Stripe payment intent.
     *
     * @param  array<string, mixed>  $args  Tool arguments (amount, currency, customer, description, metadata, capture_method, automatic_payment_methods_enabled)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $amount = $args['amount'] ?? null;
            $currency = $args['currency'] ?? '';

            if ($amount === null) {
                return ToolResult::error('amount is required.');
            }
            if (empty($currency)) {
                return ToolResult::error('currency is required.');
            }

            $data = [
                'amount' => (int) $amount,
                'currency' => strtolower($currency),
            ];

            if (isset($args['customer'])) {
                $data['customer'] = $args['customer'];
            }
            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['capture_method'])) {
                $data['capture_method'] = $args['capture_method'];
            }
            if (isset($args['automatic_payment_methods_enabled'])) {
                $data['automatic_payment_methods[enabled]'] = $args['automatic_payment_methods_enabled'] ? 'true' : 'false';
            }
            if (isset($args['metadata']) && is_array($args['metadata'])) {
                foreach ($args['metadata'] as $key => $value) {
                    $data["metadata[{$key}]"] = (string) $value;
                }
            }

            $result = $this->service->createPaymentIntent($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'amount' => $result['amount'] ?? 0,
                'currency' => $result['currency'] ?? '',
                'status' => $result['status'] ?? '',
                'client_secret' => $result['client_secret'] ?? null,
                'capture_method' => $result['capture_method'] ?? 'automatic',
                'customer' => $result['customer'] ?? null,
                'created' => $result['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
