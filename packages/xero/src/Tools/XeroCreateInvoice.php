<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Xero invoice (upsert via PUT).
 *
 * Builds the invoice payload including contact, line items, dates, and status,
 * wrapped in {"Invoices": [{...}]} as required by the Xero API.
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
        Create a Xero invoice.
        Requires a type (e.g. ACCREC), contact ID or name, and line items.
        Line items should include Description, Quantity, UnitAmount, and AccountCode.
        MD;
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Invoice type, e.g. "ACCREC" (accounts receivable) or "ACCPAY" (accounts payable).'],
            'contact_id' => ['type' => 'string', 'description' => 'Xero contact ID. Either contact_id or contact_name is required.'],
            'contact_name' => ['type' => 'string', 'description' => 'Contact name to use if contact_id is not provided.'],
            'line_items' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items, each with Description, Quantity, UnitAmount, AccountCode.'],
            'date' => ['type' => 'string', 'description' => 'Invoice date (YYYY-MM-DD). Defaults to today.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date (YYYY-MM-DD).'],
            'reference' => ['type' => 'string', 'description' => 'Reference text for the invoice.'],
            'status' => ['type' => 'string', 'description' => 'Invoice status, e.g. "DRAFT" or "AUTHORISED". Default: DRAFT.'],
        ];
    }

    /**
     * Create a Xero invoice.
     *
     * @param  array<string, mixed>  $args  Tool arguments (type, contact_id, contact_name, line_items, date, due_date, reference, status)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $type = $args['type'] ?? '';
            $lineItems = $args['line_items'] ?? [];

            if (empty($type)) {
                return ToolResult::error('type is required (e.g. ACCREC or ACCPAY).');
            }

            if (empty($lineItems) || ! is_array($lineItems)) {
                return ToolResult::error('line_items is required and must be an array.');
            }

            $invoice = [
                'Type' => $type,
                'LineItems' => $lineItems,
            ];

            // Contact: use ID or name
            if (! empty($args['contact_id'])) {
                $invoice['Contact'] = ['ContactID' => $args['contact_id']];
            } elseif (! empty($args['contact_name'])) {
                $invoice['Contact'] = ['Name' => $args['contact_name']];
            } else {
                return ToolResult::error('Either contact_id or contact_name is required.');
            }

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

            $result = $this->service->createInvoice(['Invoices' => [$invoice]]);

            $created = $result['Invoices'][0] ?? [];

            return ToolResult::success([
                'id' => $created['InvoiceID'] ?? '',
                'number' => $created['InvoiceNumber'] ?? null,
                'type' => $created['Type'] ?? '',
                'status' => $created['Status'] ?? '',
                'total' => $created['Total'] ?? 0,
                'currency' => $created['CurrencyCode'] ?? '',
                'date' => $created['Date'] ?? '',
                'due_date' => $created['DueDate'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
