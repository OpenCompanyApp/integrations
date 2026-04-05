<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single Xero invoice by ID.
 *
 * Fetches the full invoice details including line items, totals, and status.
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
        Retrieve a single Xero invoice by ID.
        Returns full invoice details including line items, contact, and status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero invoice GUID.'],
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

            $invoiceId = $args['invoice_id'] ?? '';
            if (empty($invoiceId)) {
                return ToolResult::error('invoice_id is required.');
            }

            $result = $this->service->getInvoice($invoiceId);
            $invoice = $result['Invoices'][0] ?? [];

            return ToolResult::success([
                'id' => $invoice['InvoiceID'] ?? '',
                'number' => $invoice['InvoiceNumber'] ?? '',
                'type' => $invoice['Type'] ?? '',
                'status' => $invoice['Status'] ?? '',
                'contact' => [
                    'id' => $invoice['Contact']['ContactID'] ?? '',
                    'name' => $invoice['Contact']['Name'] ?? '',
                ],
                'date' => $invoice['Date'] ?? '',
                'due_date' => $invoice['DueDate'] ?? '',
                'sub_total' => $invoice['SubTotal'] ?? 0,
                'total_tax' => $invoice['TotalTax'] ?? 0,
                'total' => $invoice['Total'] ?? 0,
                'currency' => $invoice['CurrencyCode'] ?? '',
                'reference' => $invoice['Reference'] ?? '',
                'line_items' => $invoice['LineItems'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
