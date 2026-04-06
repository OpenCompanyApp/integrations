<?php

namespace OpenCompany\Integrations\Paystack\Tools;

use OpenCompany\Integrations\Paystack\PaystackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaystackListTransactions implements Tool
{
    public function __construct(
        private PaystackService $service,
    ) {}

    public function name(): string
    {
        return 'paystack_list_transactions';
    }

    public function description(): string
    {
        return 'List transactions on your Paystack integration. Supports filtering by status, customer, and date range with pagination.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of transactions per page (default: 50, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number to retrieve.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "success", "failed", "abandoned", "reversed".'],
            'customer' => ['type' => 'string', 'description' => 'Filter by customer ID or email.'],
            'from' => ['type' => 'string', 'description' => 'Start date for filtering (ISO 8601, e.g., "2025-01-01T00:00:00").'],
            'to' => ['type' => 'string', 'description' => 'End date for filtering (ISO 8601, e.g., "2025-01-31T23:59:59").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paystack integration is not configured.');
            }

            $params = [];

            if (isset($args['per_page'])) {
                $params['perPage'] = (int) $args['per_page'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['customer'])) {
                $params['customer'] = $args['customer'];
            }
            if (isset($args['from'])) {
                $params['from'] = $args['from'];
            }
            if (isset($args['to'])) {
                $params['to'] = $args['to'];
            }

            $result = $this->service->listTransactions($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
