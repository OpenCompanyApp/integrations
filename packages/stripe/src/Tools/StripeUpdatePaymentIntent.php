<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Stripe payment intent.
 *
 * Supports updating description and metadata.
 */
class StripeUpdatePaymentIntent implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_update_payment_intent';
    }

    public function description(): string
    {
        return <<<'MD'
        Update a Stripe payment intent.
        Supports updating description and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Payment intent ID (e.g., "pi_...").'],
            'description' => ['type' => 'string', 'description' => 'Updated description for this payment.'],
            'metadata' => ['type' => 'object', 'description' => 'Key-value pairs for additional metadata.'],
        ];
    }

    /**
     * Update a Stripe payment intent's description and metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, description, metadata)
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

            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['metadata']) && is_array($args['metadata'])) {
                foreach ($args['metadata'] as $key => $value) {
                    $data["metadata[{$key}]"] = (string) $value;
                }
            }

            $result = $this->service->updatePaymentIntent($id, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'amount' => $result['amount'] ?? 0,
                'currency' => $result['currency'] ?? '',
                'status' => $result['status'] ?? '',
                'description' => $result['description'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
