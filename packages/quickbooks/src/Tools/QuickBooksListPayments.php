<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks payments using a query.
 *
 * Runs a SELECT query against the QuickBooks query API to retrieve payments
 * with optional pagination via STARTPOSITION and MAXRESULTS.
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
        List QuickBooks payments.
        Returns a list of payments with key fields. Use the limit parameter to control page size.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of payments to return (default 10, max 1000).'],
        ];
    }

    /**
     * List QuickBooks payments with optional limit.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $query = "SELECT * FROM Payment STARTPOSITION 0 MAXRESULTS {$limit}";

            $result = $this->service->query($query);
            $queryResponse = $result['QueryResponse'] ?? [];
            $payments = $queryResponse['Payment'] ?? [];

            $mapped = array_map(function (array $pay) {
                return [
                    'id' => $pay['Id'] ?? '',
                    'sync_token' => $pay['SyncToken'] ?? '',
                    'customer_ref' => $pay['CustomerRef'] ?? [],
                    'total_amt' => $pay['TotalAmt'] ?? 0,
                    'unapplied_amt' => $pay['UnappliedAmt'] ?? 0,
                    'txn_date' => $pay['TxnDate'] ?? '',
                ];
            }, $payments);

            return ToolResult::success([
                'payments' => $mapped,
                'total_count' => $queryResponse['totalCount'] ?? count($mapped),
                'start_position' => $queryResponse['startPosition'] ?? 0,
                'max_results' => $queryResponse['maxResults'] ?? $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
