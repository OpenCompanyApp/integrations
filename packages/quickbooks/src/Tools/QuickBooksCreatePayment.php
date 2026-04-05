<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a QuickBooks payment and optionally link it to invoices.
 *
 * Requires a customer ID and total amount. Line items can link the payment
 * to specific invoices.
 */
class QuickBooksCreatePayment implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_create_payment';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a QuickBooks payment for a customer.
        Requires a customer ID and total amount. Optionally link to specific invoices via line items.
        Line items format: [{"Amount": 100, "LinkedTxn": [{"TxnId": "123", "TxnType": "Invoice"}]}]
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks customer ID receiving the payment.'],
            'total_amount' => ['type' => 'number', 'required' => true, 'description' => 'Total payment amount.'],
            'line_items' => ['type' => 'array', 'description' => 'Array of linked invoice line items. Each: {"Amount": 100, "LinkedTxn": [{"TxnId": "123", "TxnType": "Invoice"}]}.'],
        ];
    }

    /**
     * Create a QuickBooks payment and optionally link it to invoices.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer_id, total_amount, line_items)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $customerId = $args['customer_id'] ?? '';
            $totalAmount = $args['total_amount'] ?? null;

            if (empty($customerId)) {
                return ToolResult::error('customer_id is required.');
            }
            if ($totalAmount === null) {
                return ToolResult::error('total_amount is required.');
            }

            $data = [
                'CustomerRef' => ['value' => $customerId],
                'TotalAmt' => (float) $totalAmount,
            ];

            if (isset($args['line_items']) && is_array($args['line_items'])) {
                $data['Line'] = $args['line_items'];
            }

            $result = $this->service->createPayment($data);
            $payment = $result['Payment'] ?? $result;

            return ToolResult::success([
                'id' => $payment['Id'] ?? '',
                'sync_token' => $payment['SyncToken'] ?? '0',
                'customer_id' => $payment['CustomerRef']['value'] ?? $customerId,
                'total_amount' => $payment['TotalAmt'] ?? 0,
                'unapplied_amount' => $payment['UnappliedAmt'] ?? 0,
                'txn_date' => $payment['TxnDate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
