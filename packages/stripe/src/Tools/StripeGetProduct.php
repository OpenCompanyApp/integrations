<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Stripe product by ID.
 *
 * Returns full product details including name, description, active status, and metadata.
 */
class StripeGetProduct implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_get_product';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Stripe product by ID.
        Returns full product details including name, description, active status, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Stripe product ID (e.g., "prod_...").'],
        ];
    }

    /**
     * Retrieve a Stripe product by ID with full details.
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

            $product = $this->service->getProduct($id);

            return ToolResult::success([
                'id' => $product['id'] ?? '',
                'name' => $product['name'] ?? '',
                'description' => $product['description'] ?? null,
                'active' => $product['active'] ?? true,
                'metadata' => $product['metadata'] ?? [],
                'created' => $product['created'] ?? null,
                'updated' => $product['updated'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
