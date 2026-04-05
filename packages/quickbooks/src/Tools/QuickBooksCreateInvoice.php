<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a QuickBooks invoice for a customer.
 *
 * Sends a POST request to the QuickBooks invoice endpoint with customer reference,
 * line items, and optional due date. Returns the created invoice details.
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
        Create a new QuickBooks invoice for a customer.
        Provide customer_id, line_items (array of items with DetailType, Amount, and SalesItemLineDetail),
        and an optional due_date. Returns the created invoice with its ID and sync token.
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks customer ID to bill.'],
            'line_items' => ['type' => 'object', 'required' => true, 'description' => 'Array of line items. Each item should include DetailType, Amount, and SalesItemLineDetail with ItemRef.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date for the invoice in YYYY-MM-DD format.'],
        ];
    }

    /**
     * Create a QuickBooks invoice.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer_id, line_items, due_date)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $customerId = $args['customer_id'] ?? '';
            if (empty($customerId)) {
                return ToolResult::error('customer_id is required.');
            }

            $lineItems = $args['line_items'] ?? [];
            if (empty($lineItems) || ! is_array($lineItems)) {
                return ToolResult::error('line_items is required and must be a non-empty array.');
            }

            $data = [
                'CustomerRef' => ['value' => $customerId],
                'Line' => $lineItems,
            ];

            if (! empty($args['due_date'])) {
                $data['DueDate'] = $args['due_date'];
            }

            $result = $this->service->createInvoice($data);
            $invoice = $result['Invoice'] ?? $result;

            return ToolResult::success([
                'id' => $invoice['Id'] ?? '',
                'sync_token' => $invoice['SyncToken'] ?? '',
                'doc_number' => $invoice['DocNumber'] ?? '',
                'customer_ref' => $invoice['CustomerRef'] ?? [],
                'total_amt' => $invoice['TotalAmt'] ?? 0,
                'balance' => $invoice['Balance'] ?? 0,
                'due_date' => $invoice['DueDate'] ?? '',
                'status' => $invoice['EmailStatus'] ?? '',
                'line_items' => $invoice['Line'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
