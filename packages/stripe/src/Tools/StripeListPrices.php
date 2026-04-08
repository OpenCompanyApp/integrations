<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Stripe prices with optional filtering.
 *
 * Supports filtering by product, active status, and pagination.
 */
class StripeListPrices implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_list_prices';
    }

    public function description(): string
    {
        return <<<'MD'
        List Stripe prices with optional filtering.
        Supports filtering by product, active status, and pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'product' => ['type' => 'string', 'description' => 'Filter by product ID.'],
            'active' => ['type' => 'boolean', 'description' => 'Filter by active status.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of prices to return (1–100, default 10).'],
            'starting_after' => ['type' => 'string', 'description' => 'Cursor for pagination — price ID to start after.'],
        ];
    }

    /**
     * List Stripe prices with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (product, active, limit, starting_after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $params = [];

            if (isset($args['product'])) {
                $params['product'] = $args['product'];
            }
            if (isset($args['active'])) {
                $params['active'] = $args['active'] ? 'true' : 'false';
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['starting_after'])) {
                $params['starting_after'] = $args['starting_after'];
            }

            $result = $this->service->listPrices($params);

            $prices = array_map(function (array $p) {
                return [
                    'id' => $p['id'] ?? '',
                    'product' => $p['product'] ?? '',
                    'unit_amount' => $p['unit_amount'] ?? 0,
                    'currency' => $p['currency'] ?? '',
                    'recurring' => $p['recurring'] ?? null,
                    'active' => $p['active'] ?? true,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'prices' => $prices,
                'has_more' => $result['has_more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
