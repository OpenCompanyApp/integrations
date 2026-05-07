<?php

namespace OpenCompany\Integrations\LemonSqueezy\Tools;

use OpenCompany\Integrations\LemonSqueezy\LemonSqueezyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a Lemon Squeezy product by ID.
 *
 * Returns product details from the Lemon Squeezy JSON:API.
 */
class LemonSqueezyGetProduct implements Tool
{
    /**
     * @param  LemonSqueezyService  $service  The Lemon Squeezy API client
     */
    public function __construct(
        private LemonSqueezyService $service,
    ) {}

    public function name(): string
    {
        return 'lemonsqueezy_get_product';
    }

    public function description(): string
    {
        return 'Get details for a specific Lemon Squeezy product by ID. Returns full product information including pricing, variants, and status.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The product ID.'],
        ];
    }

    /**
     * Get one Lemon Squeezy product.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemon Squeezy integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Product ID is required.');
            }

            $result = $this->service->getProduct($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
