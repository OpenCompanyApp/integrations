<?php

namespace OpenCompany\Integrations\ShipBob\Tools;

use OpenCompany\Integrations\ShipBob\ShipBobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single ShipBob product by its ID.
 *
 * Returns full product details including SKU, name, description,
 * inventory quantities, and fulfillment center assignments.
 */
class ShipBobGetProduct implements Tool
{
    public function __construct(
        private ShipBobService $service,
    ) {}

    public function name(): string
    {
        return 'shipbob_get_product';
    }

    public function description(): string
    {
        return 'Get details for a specific ShipBob product by ID, including SKU, inventory levels, and fulfillment info.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The ShipBob product ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ShipBob integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getProduct((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
