<?php

namespace OpenCompany\Integrations\Avalara\Tools;

use OpenCompany\Integrations\Avalara\AvalaraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AvalaraListTransactions implements Tool
{
    public function __construct(
        private AvalaraService $service,
    ) {}

    public function name(): string { return 'avalara_list_transactions'; }

    public function description(): string
    {
        return 'List transactions from Avalara. Supports filtering by date, status, and other criteria with pagination.';
    }

    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Number of transactions to return per page (default 20).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of records to skip for pagination.'],
            'filter' => ['type' => 'string', 'description' => 'OData filter expression, e.g. "status eq \'Committed\'" or "date ge 2024-01-01".'],
            'orderBy' => ['type' => 'string', 'description' => 'OData order-by expression, e.g. "date desc".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Avalara integration is not configured.');
            }

            $result = $this->service->listTransactions(
                top: isset($args['top']) ? (int) $args['top'] : null,
                skip: isset($args['skip']) ? (int) $args['skip'] : null,
                filter: $args['filter'] ?? null,
                orderBy: $args['orderBy'] ?? null,
            );

            $transactions = $result['value'] ?? $result;

            $response = [
                'transactions' => $transactions,
                'count' => is_array($transactions) ? count($transactions) : 0,
            ];

            if (isset($result['@nextLink'])) {
                $response['next_page'] = $result['@nextLink'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
