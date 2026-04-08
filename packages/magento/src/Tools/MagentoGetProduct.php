<?php

namespace OpenCompany\Integrations\Magento\Tools;

use OpenCompany\Integrations\Magento\MagentoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Magento product by SKU.
 *
 * Retrieves the full product object including attributes, pricing,
 * stock status, and media gallery.
 */
class MagentoGetProduct implements Tool
{
    /**
     * Create a new MagentoGetProduct tool instance.
     *
     * @param  \OpenCompany\Integrations\Magento\MagentoService  $service
     */
    public function __construct(
        private MagentoService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'magento_get_product';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get details of a specific Magento product by its SKU. Returns the full product object including attributes, pricing, and stock information.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'sku' => ['type' => 'string', 'required' => true, 'description' => 'The product SKU (Stock Keeping Unit) to retrieve.'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Magento integration is not configured.');
            }

            $sku = $args['sku'] ?? '';

            if (empty($sku)) {
                return ToolResult::error('sku is required.');
            }

            $result = $this->service->getProduct($sku);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
