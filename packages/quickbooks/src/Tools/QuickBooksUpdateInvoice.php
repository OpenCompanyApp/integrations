<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing QuickBooks invoice.
 *
 * Performs a full update using the sync token pattern. Requires the invoice ID,
 * current sync token, and updated line items. Sends a POST with operation=update.
 */
class QuickBooksUpdateInvoice implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_update_invoice';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing QuickBooks invoice.
        Requires the invoice ID, current sync token, and updated line items.
        Uses the QuickBooks sparse update operation (POST /invoice?operation=update).
        MD;
    }

    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks invoice ID to update.'],
            'sync_token' => ['type' => 'string', 'required' => true, 'description' => 'Current sync token of the invoice (incremented on each update).'],
            'line_items' => ['type' => 'object', 'required' => true, 'description' => 'Updated array of line items. Each item should include DetailType, Amount, and SalesItemLineDetail with ItemRef.'],
        ];
    }

    /**
     * Update an existing QuickBooks invoice.
     *
     * @param  array<string, mixed>  $args  Tool arguments (invoice_id, sync_token, line_items)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $invoiceId = $args['invoice_id'] ?? '';
            if (empty($invoiceId)) {
                return ToolResult::error('invoice_id is required.');
            }

            $syncToken = $args['sync_token'] ?? '';
            if ($syncToken === '') {
                return ToolResult::error('sync_token is required.');
            }

            $lineItems = $args['line_items'] ?? [];
            if (empty($lineItems) || ! is_array($lineItems)) {
                return ToolResult::error('line_items is required and must be a non-empty array.');
            }

            $data = [
                'Id' => $invoiceId,
                'SyncToken' => $syncToken,
                'Line' => $lineItems,
            ];

            $result = $this->service->updateInvoice($data);
            $invoice = $result['Invoice'] ?? $result;

            return ToolResult::success([
                'id' => $invoice['Id'] ?? '',
                'sync_token' => $invoice['SyncToken'] ?? '',
                'doc_number' => $invoice['DocNumber'] ?? '',
                'customer_ref' => $invoice['CustomerRef'] ?? [],
                'total_amt' => $invoice['TotalAmt'] ?? 0,
                'balance' => $invoice['Balance'] ?? 0,
                'due_date' => $invoice['DueDate'] ?? '',
                'line_items' => $invoice['Line'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
