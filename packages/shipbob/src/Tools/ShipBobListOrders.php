<?php

namespace OpenCompany\Integrations\ShipBob\Tools;

use OpenCompany\Integrations\ShipBob\ShipBobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List fulfillment orders from ShipBob with pagination and optional status filtering.
 *
 * Returns a paginated list of orders. Use the `page` and `limit` parameters to
 * navigate through results. Optionally filter by order status such as
 * "pending", "fulfilled", or "cancelled".
 */
class ShipBobListOrders implements Tool
{
    public function __construct(
        private ShipBobService $service,
    ) {}

    public function name(): string
    {
        return 'shipbob_list_orders';
    }

    public function description(): string
    {
        return 'List fulfillment orders from ShipBob. Supports pagination and filtering by status (e.g. pending, fulfilled, cancelled).';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of orders per page (default: 25, max: 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter by order status. Common values: pending, processing, fulfilled, cancelled.'],
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
            $status = $args['status'] ?? null;

            $result = $this->service->listOrders($page, $limit, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
