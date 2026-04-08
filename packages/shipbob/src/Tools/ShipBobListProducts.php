<?php

namespace OpenCompany\Integrations\ShipBob\Tools;

use OpenCompany\Integrations\ShipBob\ShipBobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List products in your ShipBob inventory with pagination.
 *
 * Returns a paginated list of products including SKU, name, quantity
 * on hand, and other inventory details.
 */
class ShipBobListProducts implements Tool
{
    public function __construct(
        private ShipBobService $service,
    ) {}

    public function name(): string
    {
        return 'shipbob_list_products';
    }

    public function description(): string
    {
        return 'List products in your ShipBob inventory. Supports pagination with page and limit parameters.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of products per page (default: 25, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ShipBob integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;

            $result = $this->service->listProducts($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
