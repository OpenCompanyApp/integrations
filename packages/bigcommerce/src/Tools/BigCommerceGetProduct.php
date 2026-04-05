<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single product from the BigCommerce catalog by ID.
 */
class BigCommerceGetProduct implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_get_product';
    }

    public function description(): string
    {
        return 'Get a single product from the BigCommerce catalog by its ID. Returns full product details.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The product ID.'],
            'include' => ['type' => 'string', 'description' => 'Comma-separated related resources to include (e.g., "variants,images,custom_fields,bulk_pricing_rules").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BigCommerce integration is not configured.');
            }

            $params = [];
            if (isset($args['include'])) {
                $params['include'] = $args['include'];
            }

            $result = $this->service->getProduct((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
