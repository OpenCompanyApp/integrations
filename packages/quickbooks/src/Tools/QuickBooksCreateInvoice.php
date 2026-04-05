<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a QuickBooks invoice for a customer.
 *
 * Requires a customer ID and at least one line item. Supports due date,
 * transaction date, and a private note.
 */
class QuickBooksCreateInvoice implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_create_invoice';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a QuickBooks invoice for a customer.
        Requires a customer ID and at least one line item. Supports due date, transaction date, and a private note.
        Line items should include Amount, DetailType ("SalesItemLineDetail"), and SalesItemLineDetail with ItemRef, Qty, and UnitPrice.
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks customer ID to bill.'],
            'line_items' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items. Each item: {"Amount": 100, "DetailType": "SalesItemLineDetail", "SalesItemLineDetail": {"ItemRef": {"value": "1"}, "Qty": 1, "UnitPrice": 100}}.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date in YYYY-MM-DD format.'],
            'txn_date' => ['type' => 'string', 'description' => 'Transaction (invoice) date in YYYY-MM-DD format.'],
            'private_note' => ['type' => 'string', 'description' => 'Internal note (not visible to customer).'],
        ];
    }

    /**
     * Create a QuickBooks invoice for a customer.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer_id, line_items, due_date, txn_date, private_note)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $customerId = $args['customer_id'] ?? '';
            $lineItems = $args['line_items'] ?? [];

            if (empty($customerId)) {
                return ToolResult::error('customer_id is required.');
            }
            if (empty($lineItems) || ! is_array($lineItems)) {
                return ToolResult::error('line_items is required and must be a non-empty array.');
            }

            $data = [
                'CustomerRef' => ['value' => $customerId],
                'Line' => $lineItems,
            ];

            if (isset($args['due_date'])) {
                $data['DueDate'] = $args['due_date'];
            }
            if (isset($args['txn_date'])) {
                $data['TxnDate'] = $args['txn_date'];
            }
            if (isset($args['private_note'])) {
                $data['PrivateNote'] = $args['private_note'];
            }

            $result = $this->service->createInvoice($data);
            $invoice = $result['Invoice'] ?? $result;

            return ToolResult::success([
                'id' => $invoice['Id'] ?? '',
                'sync_token' => $invoice['SyncToken'] ?? '0',
                'doc_number' => $invoice['DocNumber'] ?? null,
                'customer_id' => $invoice['CustomerRef']['value'] ?? $customerId,
                'total' => $invoice['TotalAmt'] ?? 0,
                'balance' => $invoice['Balance'] ?? 0,
                'due_date' => $invoice['DueDate'] ?? null,
                'txn_date' => $invoice['TxnDate'] ?? null,
                'status' => $invoice['EmailStatus'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
