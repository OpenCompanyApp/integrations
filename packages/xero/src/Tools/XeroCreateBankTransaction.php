<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Xero bank transaction (upsert via PUT).
 *
 * Records a spend or receive bank transaction with contact, line items,
 * and bank account reference.
 */
class XeroCreateBankTransaction implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_create_bank_transaction';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a Xero bank transaction (spend or receive money).
        Requires type, contact ID, line items, and bank account ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Transaction type: SPEND, RECEIVE, SPENDTRANSFER, or RECEIVETRANSFER.'],
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero contact GUID.'],
            'line_items' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items, each with Description, Quantity, UnitAmount, AccountCode.'],
            'bank_account_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero bank account GUID.'],
            'date' => ['type' => 'string', 'description' => 'Transaction date (YYYY-MM-DD). Defaults to today.'],
            'reference' => ['type' => 'string', 'description' => 'Transaction reference text.'],
        ];
    }

    /**
     * Create a Xero bank transaction.
     *
     * @param  array<string, mixed>  $args  Tool arguments (type, contact_id, line_items, bank_account_id, date, reference)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $type = $args['type'] ?? '';
            $contactId = $args['contact_id'] ?? '';
            $lineItems = $args['line_items'] ?? [];
            $bankAccountId = $args['bank_account_id'] ?? '';

            if (empty($type)) {
                return ToolResult::error('type is required.');
            }
            if (empty($contactId)) {
                return ToolResult::error('contact_id is required.');
            }
            if (empty($lineItems) || ! is_array($lineItems)) {
                return ToolResult::error('line_items is required and must be an array.');
            }
            if (empty($bankAccountId)) {
                return ToolResult::error('bank_account_id is required.');
            }

            $transaction = [
                'Type' => $type,
                'Contact' => ['ContactID' => $contactId],
                'LineItems' => $lineItems,
                'BankAccount' => ['AccountID' => $bankAccountId],
            ];

            if (! empty($args['date'])) {
                $transaction['Date'] = $args['date'];
            }
            if (! empty($args['reference'])) {
                $transaction['Reference'] = $args['reference'];
            }

            $result = $this->service->createBankTransaction(['BankTransactions' => [$transaction]]);

            $created = $result['BankTransactions'][0] ?? [];

            return ToolResult::success([
                'id' => $created['BankTransactionID'] ?? '',
                'type' => $created['Type'] ?? '',
                'contact' => $created['Contact']['Name'] ?? '',
                'total' => $created['Total'] ?? 0,
                'currency' => $created['CurrencyCode'] ?? '',
                'date' => $created['Date'] ?? '',
                'status' => $created['Status'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
