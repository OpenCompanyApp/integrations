<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a QuickBooks bill from a vendor.
 *
 * Requires a vendor ID and at least one line item. Supports a due date.
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
        Requires a vendor ID and at least one line item. Supports a due date.
        Line items should include Amount, DetailType ("AccountBasedDetailLineDetail"), and AccountBasedDetailLineDetail with AccountRef.
        MD;
    }

    public function parameters(): array
    {
        return [
            'vendor_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks vendor ID.'],
            'line_items' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items. Each: {"Amount": 100, "DetailType": "AccountBasedDetailLineDetail", "AccountBasedDetailLineDetail": {"AccountRef": {"value": "1"}}}.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date in YYYY-MM-DD format.'],
        ];
    }

    /**
     * Create a QuickBooks bill from a vendor with line items.
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
            $lineItems = $args['line_items'] ?? [];

            if (empty($vendorId)) {
                return ToolResult::error('vendor_id is required.');
            }
            if (empty($lineItems) || ! is_array($lineItems)) {
                return ToolResult::error('line_items is required and must be a non-empty array.');
            }

            $data = [
                'VendorRef' => ['value' => $vendorId],
                'Line' => $lineItems,
            ];

            if (isset($args['due_date'])) {
                $data['DueDate'] = $args['due_date'];
            }

            $result = $this->service->createBill($data);
            $bill = $result['Bill'] ?? $result;

            return ToolResult::success([
                'id' => $bill['Id'] ?? '',
                'sync_token' => $bill['SyncToken'] ?? '0',
                'doc_number' => $bill['DocNumber'] ?? null,
                'vendor_id' => $bill['VendorRef']['value'] ?? $vendorId,
                'total' => $bill['TotalAmt'] ?? 0,
                'balance' => $bill['Balance'] ?? 0,
                'due_date' => $bill['DueDate'] ?? null,
                'txn_date' => $bill['TxnDate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
