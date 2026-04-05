<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing QuickBooks invoice.
 *
 * Requires the invoice ID and sync token for optimistic concurrency.
 * Supports updating line items and private note.
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
        Requires the invoice ID and sync token for optimistic concurrency.
        Supports updating line items and private note.
        Line items should include Amount, DetailType ("SalesItemLineDetail"), and SalesItemLineDetail with ItemRef, Qty, and UnitPrice.
        MD;
    }

    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks invoice ID to update.'],
            'sync_token' => ['type' => 'string', 'required' => true, 'description' => 'Current sync token for optimistic concurrency.'],
            'line_items' => ['type' => 'array', 'description' => 'Updated array of line items.'],
            'private_note' => ['type' => 'string', 'description' => 'Updated internal note (not visible to customer).'],
        ];
    }

    /**
     * Update an existing QuickBooks invoice with new line items or notes.
     *
     * @param  array<string, mixed>  $args  Tool arguments (invoice_id, sync_token, line_items, private_note)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $invoiceId = $args['invoice_id'] ?? '';
            $syncToken = $args['sync_token'] ?? '';

            if (empty($invoiceId)) {
                return ToolResult::error('invoice_id is required.');
            }
            if ($syncToken === '') {
                return ToolResult::error('sync_token is required for optimistic concurrency.');
            }

            $data = [
                'Id' => $invoiceId,
                'SyncToken' => $syncToken,
            ];

            if (isset($args['line_items']) && is_array($args['line_items'])) {
                $data['Line'] = $args['line_items'];
            }
            if (isset($args['private_note'])) {
                $data['PrivateNote'] = $args['private_note'];
            }

            $result = $this->service->updateInvoice($data);
            $invoice = $result['Invoice'] ?? $result;

            return ToolResult::success([
                'id' => $invoice['Id'] ?? '',
                'sync_token' => $invoice['SyncToken'] ?? '',
                'doc_number' => $invoice['DocNumber'] ?? null,
                'total' => $invoice['TotalAmt'] ?? 0,
                'balance' => $invoice['Balance'] ?? 0,
                'due_date' => $invoice['DueDate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
