<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Stripe products with optional filtering.
 *
 * Supports filtering by active status and pagination.
 */
class StripeListProducts implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_list_products';
    }

    public function description(): string
    {
        return <<<'MD'
        List Stripe products with optional filtering.
        Supports filtering by active status and pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'active' => ['type' => 'boolean', 'description' => 'Filter by active status.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of products to return (1–100, default 10).'],
            'starting_after' => ['type' => 'string', 'description' => 'Cursor for pagination — product ID to start after.'],
        ];
    }

    /**
     * List Stripe products with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (active, limit, starting_after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $params = [];

            if (isset($args['active'])) {
                $params['active'] = $args['active'] ? 'true' : 'false';
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['starting_after'])) {
                $params['starting_after'] = $args['starting_after'];
            }

            $result = $this->service->listProducts($params);

            $products = array_map(function (array $p) {
                return [
                    'id' => $p['id'] ?? '',
                    'name' => $p['name'] ?? '',
                    'description' => $p['description'] ?? null,
                    'active' => $p['active'] ?? true,
                    'created' => $p['created'] ?? null,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'products' => $products,
                'has_more' => $result['has_more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
