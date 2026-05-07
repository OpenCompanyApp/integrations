<?php

namespace OpenCompany\Integrations\Revolut\Tools;

use OpenCompany\Integrations\Revolut\RevolutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Revolut transactions with optional filters.
 *
 * Supports filtering by account, date range, type, and pagination with count.
 */
class RevolutListTransactions implements Tool
{
    /**
     * @param  RevolutService  $service  The Revolut API client
     */
    public function __construct(
        private RevolutService $service,
    ) {}

    public function name(): string
    {
        return 'revolut_list_transactions';
    }

    public function description(): string
    {
        return <<<'MD'
        List Revolut transactions with optional filters.
        Supports filtering by account, date range, type, and pagination with count.
        MD;
    }

    public function parameters(): array
    {
        return [
            'account_id' => ['type' => 'string', 'description' => 'Filter transactions by account ID. Sent to Revolut as account.'],
            'from' => ['type' => 'string', 'description' => 'Start date for transactions (ISO 8601, e.g., "2026-01-01T00:00:00Z").'],
            'to' => ['type' => 'string', 'description' => 'End date for transactions (ISO 8601, e.g., "2026-04-07T23:59:59Z").'],
            'count' => ['type' => 'integer', 'description' => 'Number of transactions to return (max 1000).'],
            'type' => ['type' => 'string', 'description' => 'Filter by transaction type (e.g., "card_payment", "transfer", "exchange").'],
        ];
    }

    /**
     * List Revolut transactions with optional filtering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (account_id, from, to, count, type)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Revolut integration is not configured.');
            }

            $params = [];

            if (isset($args['account_id'])) {
                $params['account'] = $args['account_id'];
            }
            if (isset($args['from'])) {
                $params['from'] = $args['from'];
            }
            if (isset($args['to'])) {
                $params['to'] = $args['to'];
            }
            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['type'])) {
                $params['type'] = $args['type'];
            }

            $result = $this->service->listTransactions($params);

            $transactions = array_map(function (array $t) {
                return [
                    'id' => $t['id'] ?? '',
                    'type' => $t['type'] ?? '',
                    'state' => $t['state'] ?? '',
                    'amount' => $t['legs'][0]['amount'] ?? $t['amount'] ?? 0,
                    'currency' => $t['legs'][0]['currency'] ?? $t['currency'] ?? '',
                    'description' => $t['description'] ?? '',
                    'reference' => $t['reference'] ?? null,
                    'created_at' => $t['created_at'] ?? null,
                    'updated_at' => $t['updated_at'] ?? null,
                ];
            }, is_array($result) ? $result : []);

            return ToolResult::success([
                'transactions' => $transactions,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
