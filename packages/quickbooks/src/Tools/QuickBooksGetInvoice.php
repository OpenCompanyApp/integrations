<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a QuickBooks invoice by ID.
 */
class QuickBooksGetInvoice implements Tool
{
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_get_invoice';
    }

    public function description(): string
    {
        return 'Retrieve a QuickBooks invoice by ID. Returns full invoice details including line items, totals, balance, and status.';
    }

    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks invoice ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $invoiceId = $args['invoice_id'] ?? '';
            if (empty($invoiceId)) {
                return ToolResult::error('invoice_id is required.');
            }

            $result = $this->service->getInvoice($invoiceId);
            $invoice = $result['Invoice'] ?? $result;

            return ToolResult::success([
                'id' => $invoice['Id'] ?? '',
                'sync_token' => $invoice['SyncToken'] ?? '',
                'doc_number' => $invoice['DocNumber'] ?? '',
                'customer_ref' => $invoice['CustomerRef'] ?? [],
                'total_amt' => $invoice['TotalAmt'] ?? 0,
                'balance' => $invoice['Balance'] ?? 0,
                'due_date' => $invoice['DueDate'] ?? '',
                'txn_date' => $invoice['TxnDate'] ?? '',
                'status' => $invoice['EmailStatus'] ?? '',
                'line_items' => $invoice['Line'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
