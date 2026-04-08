<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Stripe product.
 *
 * Products are the goods or services you sell. After creating a product, create a price for it.
 */
class StripeCreateProduct implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_create_product';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new Stripe product.
        Products are the goods or services you sell. After creating a product, create a price for it.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Product name.'],
            'description' => ['type' => 'string', 'description' => 'Product description.'],
            'active' => ['type' => 'boolean', 'description' => 'Whether the product is active. Default: true.'],
            'metadata' => ['type' => 'object', 'description' => 'Key-value pairs for additional metadata.'],
        ];
    }

    /**
     * Create a new Stripe product.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, description, active, metadata)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['active'])) {
                $data['active'] = $args['active'] ? 'true' : 'false';
            }
            if (isset($args['metadata']) && is_array($args['metadata'])) {
                foreach ($args['metadata'] as $key => $value) {
                    $data["metadata[{$key}]"] = (string) $value;
                }
            }

            $result = $this->service->createProduct($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'description' => $result['description'] ?? null,
                'active' => $result['active'] ?? true,
                'created' => $result['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
