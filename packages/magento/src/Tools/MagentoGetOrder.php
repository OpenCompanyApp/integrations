<?php

namespace OpenCompany\Integrations\Magento\Tools;

use OpenCompany\Integrations\Magento\MagentoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Magento order by ID.
 *
 * Retrieves the full order object including items, billing/shipping
 * addresses, payment info, and totals.
 */
class MagentoGetOrder implements Tool
{
    /**
     * Create a new MagentoGetOrder tool instance.
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
        return 'magento_get_order';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get details of a specific Magento order by its ID. Returns the full order object including items, addresses, payment, and totals.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'order_id' => ['type' => 'string', 'required' => true, 'description' => 'The order increment ID or entity ID.'],
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

            $orderId = $args['order_id'] ?? '';

            if (empty($orderId)) {
                return ToolResult::error('order_id is required.');
            }

            $result = $this->service->getOrder($orderId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
