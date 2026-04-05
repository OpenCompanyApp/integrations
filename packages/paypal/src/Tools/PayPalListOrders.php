<?php

namespace OpenCompany\Integrations\PayPal\Tools;

use OpenCompany\Integrations\PayPal\PayPalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing PayPal checkout orders.
 *
 * Retrieves a list of checkout orders from the PayPal API
 * with optional filtering by query parameters.
 */
class PayPalListOrders implements Tool
{
    /**
     * Create a new PayPalListOrders tool instance.
     *
     * @param  PayPalService  $service  The PayPal API service.
     */
    public function __construct(
        private PayPalService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'paypal_list_orders';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'List PayPal checkout orders. Returns order IDs, statuses, and amounts. Use filters to narrow results by status or date range.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of orders to return per page (default: 20, max: 100).'],
            'start_id' => ['type' => 'string', 'description' => 'The ID of the first order to return. Used for pagination.'],
            'start_time' => ['type' => 'string', 'description' => 'Start time for filtering (ISO 8601, e.g., "2025-01-01T00:00:00Z").'],
            'end_time' => ['type' => 'string', 'description' => 'End time for filtering (ISO 8601, e.g., "2025-12-31T23:59:59Z").'],
            'status' => ['type' => 'string', 'description' => 'Filter by order status: CREATED, SAVED, APPROVED, VOIDED, COMPLETED, PAYER_ACTION_REQUIRED.'],
        ];
    }

    /**
     * Execute the list orders request.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PayPal integration is not configured.');
            }

            $params = [];
            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }
            if (isset($args['start_id'])) {
                $params['start_id'] = $args['start_id'];
            }
            if (isset($args['start_time'])) {
                $params['start_time'] = $args['start_time'];
            }
            if (isset($args['end_time'])) {
                $params['end_time'] = $args['end_time'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            $result = $this->service->listOrders($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
