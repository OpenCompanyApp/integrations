<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks payments using a SQL-like query.
 *
 * Supports pagination via limit. Returns an array of payment summaries.
 */
class QuickBooksListPayments implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_list_payments';
    }

    public function description(): string
    {
        return <<<'MD'
        List QuickBooks payments using a SQL-like query.
        Supports pagination via limit. Returns payment summaries.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of payments to return (1–1000, default 100).'],
        ];
    }

    /**
     * List QuickBooks payments with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;

            $query = "SELECT * FROM Payment MAXRESULTS {$limit}";

            $result = $this->service->query($query);
            $queryResponse = $result['QueryResponse'] ?? [];
            $payments = $queryResponse['Payment'] ?? [];

            $mapped = array_map(function (array $p) {
                return [
                    'id' => $p['Id'] ?? '',
                    'sync_token' => $p['SyncToken'] ?? '0',
                    'customer_id' => $p['CustomerRef']['value'] ?? '',
                    'customer_name' => $p['CustomerRef']['name'] ?? null,
                    'total_amount' => $p['TotalAmt'] ?? 0,
                    'unapplied_amount' => $p['UnappliedAmt'] ?? 0,
                    'txn_date' => $p['TxnDate'] ?? null,
                ];
            }, $payments);

            return ToolResult::success([
                'payments' => $mapped,
                'total_count' => $queryResponse['totalCount'] ?? count($mapped),
                'max_results' => $queryResponse['maxResults'] ?? $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
