<?php

namespace OpenCompany\Integrations\LemonSqueezy\Tools;

use OpenCompany\Integrations\LemonSqueezy\LemonSqueezyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Lemon Squeezy orders.
 *
 * Supports Lemon Squeezy pagination controls.
 */
class LemonSqueezyListOrders implements Tool
{
    /**
     * @param  LemonSqueezyService  $service  The Lemon Squeezy API client
     */
    public function __construct(
        private LemonSqueezyService $service,
    ) {}

    public function name(): string
    {
        return 'lemonsqueezy_list_orders';
    }

    public function description(): string
    {
        return 'List all orders in your Lemon Squeezy store. Returns order details including status, totals, and customer info.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of orders per page (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * List orders from the configured Lemon Squeezy account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_size, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemon Squeezy integration is not configured.');
            }

            $pageSize = isset($args['page_size']) ? min((int) $args['page_size'], 100) : 10;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listOrders($pageSize, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
