<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a QuickBooks estimate for a customer.
 *
 * Requires a customer ID and at least one line item. Supports transaction
 * date and expiration date.
 */
class QuickBooksCreateEstimate implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_create_estimate';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a QuickBooks estimate for a customer.
        Requires a customer ID and at least one line item. Supports transaction date and expiration date.
        Line items should include Amount, DetailType ("SalesItemLineDetail"), and SalesItemLineDetail with ItemRef, Qty, and UnitPrice.
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks customer ID.'],
            'line_items' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items. Each: {"Amount": 100, "DetailType": "SalesItemLineDetail", "SalesItemLineDetail": {"ItemRef": {"value": "1"}, "Qty": 1, "UnitPrice": 100}}.'],
            'txn_date' => ['type' => 'string', 'description' => 'Transaction date in YYYY-MM-DD format.'],
            'expiration_date' => ['type' => 'string', 'description' => 'Expiration date in YYYY-MM-DD format.'],
        ];
    }

    /**
     * Create a QuickBooks estimate for a customer.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer_id, line_items, txn_date, expiration_date)
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

            if (isset($args['txn_date'])) {
                $data['TxnDate'] = $args['txn_date'];
            }
            if (isset($args['expiration_date'])) {
                $data['ExpirationDate'] = $args['expiration_date'];
            }

            $result = $this->service->createEstimate($data);
            $estimate = $result['Estimate'] ?? $result;

            return ToolResult::success([
                'id' => $estimate['Id'] ?? '',
                'sync_token' => $estimate['SyncToken'] ?? '0',
                'doc_number' => $estimate['DocNumber'] ?? null,
                'customer_id' => $estimate['CustomerRef']['value'] ?? $customerId,
                'total' => $estimate['TotalAmt'] ?? 0,
                'txn_date' => $estimate['TxnDate'] ?? null,
                'expiration_date' => $estimate['ExpirationDate'] ?? null,
                'status' => $estimate['TxnStatus'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
