<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Stripe payment intent by ID.
 *
 * Returns full payment intent details including amount, status, and charges.
 */
class StripeGetPaymentIntent implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_get_payment_intent';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Stripe payment intent by ID.
        Returns full payment intent details including amount, status, and charges.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Payment intent ID (e.g., "pi_...").'],
        ];
    }

    /**
     * Retrieve a Stripe payment intent by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
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

            $pi = $this->service->getPaymentIntent($id);

            return ToolResult::success([
                'id' => $pi['id'] ?? '',
                'amount' => $pi['amount'] ?? 0,
                'currency' => $pi['currency'] ?? '',
                'status' => $pi['status'] ?? '',
                'capture_method' => $pi['capture_method'] ?? 'automatic',
                'customer' => $pi['customer'] ?? null,
                'description' => $pi['description'] ?? null,
                'metadata' => $pi['metadata'] ?? [],
                'created' => $pi['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
