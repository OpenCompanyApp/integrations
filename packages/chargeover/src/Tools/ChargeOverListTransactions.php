<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChargeOverListTransactions implements Tool
{
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_list_transactions';
    }

    public function description(): string
    {
        return 'List transactions (payments) from ChargeOver. Returns payment records including amounts, methods, dates, and associated customers and invoices.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of transactions to return per page (default: 10, max: 500).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based, default: 1).'],
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

            $result = $this->service->listTransactions($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
