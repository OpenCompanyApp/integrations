<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List ChargeOver subscription package records.
 */
class ChargeOverListSubscriptions implements Tool
{
    /**
     * @param  ChargeOverService  $service  The ChargeOver API client.
     */
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_list_subscriptions';
    }

    public function description(): string
    {
        return 'List ChargeOver subscriptions, which the API exposes as package records at /api/v3/package. Supports customer filtering plus where/order/expand query parameters.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of subscriptions to return per page (default: 10, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Record offset for pagination (default: 0).'],
            'customer_id' => ['type' => 'integer', 'description' => 'Filter subscriptions by customer ID.'],
            'where' => ['type' => 'string', 'description' => 'ChargeOver where expression, e.g. package_status_state:EQUALS:a.'],
            'order' => ['type' => 'string', 'description' => 'Sort expression, e.g. package_id:DESC.'],
            'expand' => ['type' => 'string', 'description' => 'Optional expansion such as line_items.'],
        ];
    }

    /**
     * List subscription packages through the ChargeOver API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, customer_id, where, order, expand).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $customerId = isset($args['customer_id']) ? (int) $args['customer_id'] : null;

            $result = $this->service->listSubscriptions(
                $limit,
                $offset,
                $customerId,
                $args['where'] ?? null,
                $args['order'] ?? null,
                $args['expand'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
