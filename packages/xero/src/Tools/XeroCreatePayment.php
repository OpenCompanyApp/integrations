<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a payment in Xero (upsert via PUT).
 *
 * Records a payment against an invoice, specifying the bank account,
 * amount, date, and optional reference.
 */
class XeroCreatePayment implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_create_payment';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a payment in Xero against an invoice.
        Requires invoice ID, bank account ID, and amount.
        MD;
    }

    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero invoice GUID to pay.'],
            'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero bank account GUID for the payment.'],
            'amount' => ['type' => 'number', 'required' => true, 'description' => 'Payment amount.'],
            'date' => ['type' => 'string', 'description' => 'Payment date (YYYY-MM-DD). Defaults to today.'],
            'reference' => ['type' => 'string', 'description' => 'Payment reference text.'],
        ];
    }

    /**
     * Create a Xero payment against an invoice.
     *
     * @param  array<string, mixed>  $args  Tool arguments (invoice_id, account_id, amount, date, reference)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $invoiceId = $args['invoice_id'] ?? '';
            $accountId = $args['account_id'] ?? '';
            $amount = $args['amount'] ?? null;

            if (empty($invoiceId)) {
                return ToolResult::error('invoice_id is required.');
            }
            if (empty($accountId)) {
                return ToolResult::error('account_id is required.');
            }
            if ($amount === null) {
                return ToolResult::error('amount is required.');
            }

            $payment = [
                'Invoice' => ['InvoiceID' => $invoiceId],
                'Account' => ['AccountID' => $accountId],
                'Amount' => (float) $amount,
            ];

            if (! empty($args['date'])) {
                $payment['Date'] = $args['date'];
            }
            if (! empty($args['reference'])) {
                $payment['Reference'] = $args['reference'];
            }

            $result = $this->service->createPayment(['Payments' => [$payment]]);

            $created = $result['Payments'][0] ?? [];

            return ToolResult::success([
                'id' => $created['PaymentID'] ?? '',
                'invoice_id' => $created['Invoice']['InvoiceID'] ?? '',
                'account_id' => $created['Account']['AccountID'] ?? '',
                'amount' => $created['Amount'] ?? 0,
                'date' => $created['Date'] ?? '',
                'status' => $created['Status'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
