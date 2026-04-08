<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChargeOverListSubscriptions implements Tool
{
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_list_subscriptions';
    }

    public function description(): string
    {
        return 'List subscriptions from ChargeOver. Returns subscription details including plan, billing cycle, status, and associated customer. Supports filtering by customer.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of subscriptions to return per page (default: 10, max: 500).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based, default: 1).'],
            'customer_id' => ['type' => 'integer', 'description' => 'Filter subscriptions by customer ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $customerId = isset($args['customer_id']) ? (int) $args['customer_id'] : null;

            $result = $this->service->listSubscriptions($limit, $page, $customerId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
