<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a QuickBooks payment for a customer.
 *
 * Records a payment against a customer account. Can optionally link
 * the payment to specific invoices via line items.
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
        Provide customer_id and total_amount. Optionally include line items to link the payment to specific invoices.
        Returns the created payment with its ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks customer ID receiving the payment.'],
            'total_amount' => ['type' => 'string', 'required' => true, 'description' => 'Total payment amount as a decimal string (e.g., "150.00").'],
        ];
    }

    /**
     * Create a QuickBooks payment.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer_id, total_amount)
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

            $totalAmount = $args['total_amount'] ?? '';
            if (empty($totalAmount)) {
                return ToolResult::error('total_amount is required.');
            }

            $data = [
                'CustomerRef' => ['value' => $customerId],
                'TotalAmt' => $totalAmount,
            ];

            $result = $this->service->createPayment($data);
            $payment = $result['Payment'] ?? $result;

            return ToolResult::success([
                'id' => $payment['Id'] ?? '',
                'sync_token' => $payment['SyncToken'] ?? '',
                'customer_ref' => $payment['CustomerRef'] ?? [],
                'total_amt' => $payment['TotalAmt'] ?? 0,
                'unapplied_amt' => $payment['UnappliedAmt'] ?? 0,
                'txn_date' => $payment['TxnDate'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
