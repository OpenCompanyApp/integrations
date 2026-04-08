<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a price for a Stripe product.
 *
 * Supports one-time and recurring prices with configurable intervals. Amounts are in cents.
 */
class StripeCreatePrice implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_create_price';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a price for a Stripe product.
        Amounts are in cents (e.g., $10.00 = 1000).
        Supports one-time and recurring prices with configurable intervals.
        MD;
    }

    public function parameters(): array
    {
        return [
            'product' => ['type' => 'string', 'required' => true, 'description' => 'Product ID this price belongs to (e.g., "prod_...").'],
            'unit_amount' => ['type' => 'integer', 'required' => true, 'description' => 'Price in cents (e.g., 1000 = $10.00).'],
            'currency' => ['type' => 'string', 'required' => true, 'description' => 'Three-letter currency code (e.g., "usd", "eur").'],
            'recurring_interval' => ['type' => 'string', 'description' => 'Recurring interval: "day", "week", "month", or "year". Omit for one-time prices.'],
            'recurring_interval_count' => ['type' => 'integer', 'description' => 'Number of intervals between billings (e.g., 3 for every 3 months). Default: 1.'],
            'metadata' => ['type' => 'object', 'description' => 'Key-value pairs for additional metadata.'],
        ];
    }

    /**
     * Create a price for a Stripe product.
     *
     * @param  array<string, mixed>  $args  Tool arguments (product, unit_amount, currency, recurring_interval, recurring_interval_count, metadata)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $product = $args['product'] ?? '';
            $unitAmount = $args['unit_amount'] ?? null;
            $currency = $args['currency'] ?? '';

            if (empty($product)) {
                return ToolResult::error('product is required.');
            }
            if ($unitAmount === null) {
                return ToolResult::error('unit_amount is required.');
            }
            if (empty($currency)) {
                return ToolResult::error('currency is required.');
            }

            $data = [
                'product' => $product,
                'unit_amount' => (int) $unitAmount,
                'currency' => strtolower($currency),
            ];

            if (isset($args['recurring_interval'])) {
                $data['recurring[interval]'] = $args['recurring_interval'];
                if (isset($args['recurring_interval_count'])) {
                    $data['recurring[interval_count]'] = (int) $args['recurring_interval_count'];
                }
            }

            if (isset($args['metadata']) && is_array($args['metadata'])) {
                foreach ($args['metadata'] as $key => $value) {
                    $data["metadata[{$key}]"] = (string) $value;
                }
            }

            $result = $this->service->createPrice($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'product' => $result['product'] ?? '',
                'unit_amount' => $result['unit_amount'] ?? 0,
                'currency' => $result['currency'] ?? '',
                'recurring' => $result['recurring'] ?? null,
                'active' => $result['active'] ?? true,
                'created' => $result['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
