<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a QuickBooks bill from a vendor.
 *
 * Sends a bill with vendor reference, line items, and optional due date
 * to the QuickBooks bill endpoint. Returns the created bill with ID.
 */
class QuickBooksCreateBill implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_create_bill';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a QuickBooks bill from a vendor.
        Provide vendor_id, line_items (array of items with DetailType, Amount, and AccountBasedExpenseLineDetail),
        and an optional due_date. Returns the created bill with its ID and sync token.
        MD;
    }

    public function parameters(): array
    {
        return [
            'vendor_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks vendor ID to bill.'],
            'line_items' => ['type' => 'object', 'required' => true, 'description' => 'Array of line items. Each item should include DetailType, Amount, and AccountBasedExpenseLineDetail.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date for the bill in YYYY-MM-DD format.'],
        ];
    }

    /**
     * Create a QuickBooks bill.
     *
     * @param  array<string, mixed>  $args  Tool arguments (vendor_id, line_items, due_date)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $vendorId = $args['vendor_id'] ?? '';
            if (empty($vendorId)) {
                return ToolResult::error('vendor_id is required.');
            }

            $lineItems = $args['line_items'] ?? [];
            if (empty($lineItems) || ! is_array($lineItems)) {
                return ToolResult::error('line_items is required and must be a non-empty array.');
            }

            $data = [
                'VendorRef' => ['value' => $vendorId],
                'Line' => $lineItems,
            ];

            if (! empty($args['due_date'])) {
                $data['DueDate'] = $args['due_date'];
            }

            $result = $this->service->createBill($data);
            $bill = $result['Bill'] ?? $result;

            return ToolResult::success([
                'id' => $bill['Id'] ?? '',
                'sync_token' => $bill['SyncToken'] ?? '',
                'doc_number' => $bill['DocNumber'] ?? '',
                'vendor_ref' => $bill['VendorRef'] ?? [],
                'total_amt' => $bill['TotalAmt'] ?? 0,
                'balance' => $bill['Balance'] ?? 0,
                'due_date' => $bill['DueDate'] ?? '',
                'txn_date' => $bill['TxnDate'] ?? '',
                'line_items' => $bill['Line'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
