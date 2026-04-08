<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Stripe subscription for a customer.
 *
 * Requires a customer ID and a price ID. Supports quantity, trial periods, and metadata.
 */
class StripeCreateSubscription implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_create_subscription';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a Stripe subscription for a customer.
        Requires a customer ID and a price ID. Supports quantity, trial periods, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer' => ['type' => 'string', 'required' => true, 'description' => 'Stripe customer ID (e.g., "cus_...").'],
            'price' => ['type' => 'string', 'required' => true, 'description' => 'Price ID to subscribe to (e.g., "price_...").'],
            'quantity' => ['type' => 'integer', 'description' => 'Quantity for the subscription. Default: 1.'],
            'trial_period_days' => ['type' => 'integer', 'description' => 'Number of trial days before billing starts.'],
            'metadata' => ['type' => 'object', 'description' => 'Key-value pairs for additional metadata.'],
        ];
    }

    /**
     * Create a Stripe subscription for a customer.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer, price, quantity, trial_period_days, metadata)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $customer = $args['customer'] ?? '';
            $price = $args['price'] ?? '';

            if (empty($customer)) {
                return ToolResult::error('customer is required.');
            }
            if (empty($price)) {
                return ToolResult::error('price is required.');
            }

            $data = [
                'customer' => $customer,
                'items[0][price]' => $price,
            ];

            if (isset($args['quantity'])) {
                $data['items[0][quantity]'] = (int) $args['quantity'];
            }
            if (isset($args['trial_period_days'])) {
                $data['trial_period_days'] = (int) $args['trial_period_days'];
            }
            if (isset($args['metadata']) && is_array($args['metadata'])) {
                foreach ($args['metadata'] as $key => $value) {
                    $data["metadata[{$key}]"] = (string) $value;
                }
            }

            $result = $this->service->createSubscription($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'customer' => $result['customer'] ?? '',
                'status' => $result['status'] ?? '',
                'plan' => $result['plan'] ?? null,
                'trial_end' => $result['trial_end'] ?? null,
                'current_period_start' => $result['current_period_start'] ?? null,
                'current_period_end' => $result['current_period_end'] ?? null,
                'created' => $result['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
