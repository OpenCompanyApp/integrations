<?php

namespace OpenCompany\Integrations\KoFi\Tools;

use OpenCompany\Integrations\KoFi\KoFiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KoFiListTransactions implements Tool
{
    public function __construct(
        private KoFiService $service,
    ) {}

    public function name(): string
    {
        return 'ko-fi_list_transactions';
    }

    public function description(): string
    {
        return 'List all transactions on your Ko-fi page including donations, subscriptions, and shop orders. Returns transaction details with amounts and dates.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => false, 'description' => 'Filter by transaction type: donation, subscription, or shop_order.'],
            'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Number of results per page (default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ko-fi integration is not configured.');
            }

            $params = array_filter([
                'type' => $args['type'] ?? null,
                'page' => $args['page'] ?? null,
                'limit' => $args['limit'] ?? null,
            ], fn($v) => $v !== null);

            $result = $this->service->listTransactions($params);

            $transactions = $result['transactions'] ?? $result['data'] ?? [];

            return ToolResult::success([
                'transactions' => $transactions,
                'totalCount' => count($transactions),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
