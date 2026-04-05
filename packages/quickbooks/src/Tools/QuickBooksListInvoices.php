<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks invoices using a SQL-like query.
 *
 * Supports pagination via limit and start_position. Returns an array of invoice summaries.
 */
class QuickBooksListInvoices implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_list_invoices';
    }

    public function description(): string
    {
        return <<<'MD'
        List QuickBooks invoices using a SQL-like query.
        Supports pagination via limit and start_position. Returns invoice summaries.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of invoices to return (1–1000, default 100).'],
            'start_position' => ['type' => 'integer', 'description' => '1-based offset for pagination (default 1).'],
        ];
    }

    /**
     * List QuickBooks invoices with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, start_position)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $startPosition = isset($args['start_position']) ? (int) $args['start_position'] : 1;

            $query = "SELECT * FROM Invoice STARTPOSITION {$startPosition} MAXRESULTS {$limit}";

            $result = $this->service->query($query);
            $queryResponse = $result['QueryResponse'] ?? [];
            $invoices = $queryResponse['Invoice'] ?? [];

            $mapped = array_map(function (array $inv) {
                return [
                    'id' => $inv['Id'] ?? '',
                    'sync_token' => $inv['SyncToken'] ?? '0',
                    'doc_number' => $inv['DocNumber'] ?? null,
                    'customer_id' => $inv['CustomerRef']['value'] ?? '',
                    'customer_name' => $inv['CustomerRef']['name'] ?? null,
                    'total' => $inv['TotalAmt'] ?? 0,
                    'balance' => $inv['Balance'] ?? 0,
                    'due_date' => $inv['DueDate'] ?? null,
                    'txn_date' => $inv['TxnDate'] ?? null,
                ];
            }, $invoices);

            return ToolResult::success([
                'invoices' => $mapped,
                'total_count' => $queryResponse['totalCount'] ?? count($mapped),
                'start_position' => $queryResponse['startPosition'] ?? $startPosition,
                'max_results' => $queryResponse['maxResults'] ?? $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
