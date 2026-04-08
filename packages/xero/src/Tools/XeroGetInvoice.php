<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Xero invoice by ID.
 *
 * Returns the full invoice including line items, contact, and totals.
 */
class XeroGetInvoice implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_get_invoice';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Xero invoice by its ID.
        Returns the full invoice including line items, contact details, and totals.
        MD;
    }

    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero invoice ID (UUID).'],
        ];
    }

    /**
     * Retrieve a Xero invoice by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (invoice_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $id = $args['invoice_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('invoice_id is required.');
            }

            $result = $this->service->getInvoice($id);

            $invoice = $result['Invoices'][0] ?? $result;

            return ToolResult::success([
                'id' => $invoice['InvoiceID'] ?? '',
                'number' => $invoice['InvoiceNumber'] ?? '',
                'type' => $invoice['Type'] ?? '',
                'status' => $invoice['Status'] ?? '',
                'date' => $invoice['Date'] ?? '',
                'due_date' => $invoice['DueDate'] ?? '',
                'subtotal' => $invoice['SubTotal'] ?? 0,
                'total_tax' => $invoice['TotalTax'] ?? 0,
                'total' => $invoice['Total'] ?? 0,
                'total_discount' => $invoice['TotalDiscount'] ?? 0,
                'amount_due' => $invoice['AmountDue'] ?? 0,
                'amount_paid' => $invoice['AmountPaid'] ?? 0,
                'currency' => $invoice['CurrencyCode'] ?? '',
                'reference' => $invoice['Reference'] ?? '',
                'contact' => isset($invoice['Contact']) ? [
                    'id' => $invoice['Contact']['ContactID'] ?? '',
                    'name' => $invoice['Contact']['Name'] ?? '',
                ] : [],
                'line_items' => $invoice['LineItems'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
