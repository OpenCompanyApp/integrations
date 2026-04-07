<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks invoices using a query.
 */
class QuickBooksListInvoices implements Tool
{
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_list_invoices';
    }

    public function description(): string
    {
        return 'List QuickBooks invoices. Returns a list of invoices with key fields. Use the limit parameter to control page size.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of invoices to return (default 10, max 1000).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listInvoices($params);
            $queryResponse = $result['QueryResponse'] ?? [];
            $invoices = $queryResponse['Invoice'] ?? [];

            $mapped = array_map(function (array $inv) {
                return [
                    'id' => $inv['Id'] ?? '',
                    'sync_token' => $inv['SyncToken'] ?? '',
                    'doc_number' => $inv['DocNumber'] ?? '',
                    'customer_ref' => $inv['CustomerRef'] ?? [],
                    'total_amt' => $inv['TotalAmt'] ?? 0,
                    'balance' => $inv['Balance'] ?? 0,
                    'due_date' => $inv['DueDate'] ?? '',
                    'txn_date' => $inv['TxnDate'] ?? '',
                    'status' => $inv['EmailStatus'] ?? '',
                ];
            }, $invoices);

            return ToolResult::success([
                'invoices' => $mapped,
                'total_count' => $queryResponse['totalCount'] ?? count($mapped),
                'start_position' => $queryResponse['startPosition'] ?? 0,
                'max_results' => $queryResponse['maxResults'] ?? ($args['limit'] ?? 10),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
