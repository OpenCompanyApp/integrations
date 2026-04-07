<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new invoice in Xero.
 *
 * Creates an invoice with line items for a given contact.
 */
class XeroCreateInvoice implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_create_invoice';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new invoice in Xero.
        Requires a contact_id and at least one line item with description and unit_amount.
        Returns the created invoice with its ID and number.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero contact ID (UUID) to invoice.'],
            'type' => ['type' => 'string', 'required' => false, 'description' => 'Invoice type: "ACCREC" (accounts receivable) or "ACCPAY" (accounts payable). Default: ACCREC.'],
            'date' => ['type' => 'string', 'required' => false, 'description' => 'Invoice date (YYYY-MM-DD). Defaults to today.'],
            'due_date' => ['type' => 'string', 'required' => false, 'description' => 'Due date (YYYY-MM-DD).'],
            'reference' => ['type' => 'string', 'required' => false, 'description' => 'Reference text for the invoice.'],
            'line_items' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items, each with description, quantity, unit_amount, account_code, tax_type.'],
            'status' => ['type' => 'string', 'required' => false, 'description' => 'Invoice status: "DRAFT" or "AUTHORISED". Default: DRAFT.'],
        ];
    }

    /**
     * Create a new Xero invoice.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $contactId = $args['contact_id'] ?? '';
            if (empty($contactId)) {
                return ToolResult::error('contact_id is required.');
            }

            $lineItems = $args['line_items'] ?? [];
            if (empty($lineItems)) {
                return ToolResult::error('At least one line item is required.');
            }

            $invoice = [
                'Type' => $args['type'] ?? 'ACCREC',
                'Contact' => ['ContactID' => $contactId],
                'LineItems' => array_map(function (array $item): array {
                    return [
                        'Description' => $item['description'] ?? '',
                        'Quantity' => $item['quantity'] ?? 1,
                        'UnitAmount' => $item['unit_amount'] ?? 0,
                        'AccountCode' => $item['account_code'] ?? null,
                        'TaxType' => $item['tax_type'] ?? null,
                    ];
                }, $lineItems),
            ];

            if (! empty($args['date'])) {
                $invoice['Date'] = $args['date'];
            }
            if (! empty($args['due_date'])) {
                $invoice['DueDate'] = $args['due_date'];
            }
            if (! empty($args['reference'])) {
                $invoice['Reference'] = $args['reference'];
            }
            if (! empty($args['status'])) {
                $invoice['Status'] = $args['status'];
            }

            $result = $this->service->createInvoice($invoice);

            $created = $result['Invoices'][0] ?? $result;

            return ToolResult::success([
                'id' => $created['InvoiceID'] ?? '',
                'number' => $created['InvoiceNumber'] ?? '',
                'type' => $created['Type'] ?? '',
                'status' => $created['Status'] ?? '',
                'total' => $created['Total'] ?? 0,
                'date' => $created['Date'] ?? '',
                'due_date' => $created['DueDate'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
