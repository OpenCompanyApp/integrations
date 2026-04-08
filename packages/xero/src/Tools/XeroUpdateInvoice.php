<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Xero invoice (POST).
 *
 * Supports updating status and line items on an existing invoice.
 */
class XeroUpdateInvoice implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_update_invoice';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Xero invoice.
        Supports changing the status (e.g. to AUTHORISED) and updating line items.
        MD;
    }

    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero invoice GUID to update.'],
            'status' => ['type' => 'string', 'description' => 'New invoice status, e.g. "DRAFT", "AUTHORISED", "VOIDED".'],
            'line_items' => ['type' => 'array', 'description' => 'Updated line items array. Each item needs Description, Quantity, UnitAmount, AccountCode.'],
        ];
    }

    /**
     * Update a Xero invoice.
     *
     * @param  array<string, mixed>  $args  Tool arguments (invoice_id, status, line_items)
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

            $invoice = [];

            if (! empty($args['status'])) {
                $invoice['Status'] = $args['status'];
            }
            if (isset($args['line_items']) && is_array($args['line_items'])) {
                $invoice['LineItems'] = $args['line_items'];
            }

            if (empty($invoice)) {
                return ToolResult::error('At least one of status or line_items must be provided.');
            }

            $result = $this->service->updateInvoice($invoiceId, ['Invoices' => [$invoice]]);

            $updated = $result['Invoices'][0] ?? [];

            return ToolResult::success([
                'id' => $updated['InvoiceID'] ?? '',
                'number' => $updated['InvoiceNumber'] ?? '',
                'status' => $updated['Status'] ?? '',
                'total' => $updated['Total'] ?? 0,
                'currency' => $updated['CurrencyCode'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
