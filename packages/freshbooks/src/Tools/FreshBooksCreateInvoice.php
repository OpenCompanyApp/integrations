<?php

namespace OpenCompany\Integrations\FreshBooks\Tools;

use OpenCompany\Integrations\FreshBooks\FreshBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshBooksCreateInvoice implements Tool
{
    public function __construct(
        private FreshBooksService $service,
    ) {}

    public function name(): string
    {
        return 'freshbooks_create_invoice';
    }

    public function description(): string
    {
        return 'Create a new invoice in FreshBooks. Requires at minimum a client ID and line items. Supports setting due date, notes, discount, and other invoice fields.';
    }

    public function parameters(): array
    {
        return [
            'client_id' => ['type' => 'integer', 'required' => true, 'description' => 'The client ID to bill.'],
            'lines' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items. Each line should have: name (string), description (string, optional), qty (number), unit_cost (object with amount and code).'],
            'date' => ['type' => 'string', 'description' => 'Invoice date (YYYY-MM-DD). Defaults to today.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date (YYYY-MM-DD). Optional.'],
            'invoice_number' => ['type' => 'string', 'description' => 'Custom invoice number. Auto-generated if omitted.'],
            'notes' => ['type' => 'string', 'description' => 'Notes displayed on the invoice.'],
            'terms' => ['type' => 'string', 'description' => 'Payment terms (e.g., "Net 30").'],
            'discount_value' => ['type' => 'number', 'description' => 'Discount amount or percentage.'],
            'discount_type' => ['type' => 'string', 'description' => 'Discount type: "percentage" or "amount".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('FreshBooks integration is not configured. Please provide an access token and account ID.');
            }

            if (empty($args['client_id'])) {
                return ToolResult::error('client_id is required.');
            }

            if (empty($args['lines'])) {
                return ToolResult::error('At least one line item is required.');
            }

            $invoice = [
                'customerid' => (int) $args['client_id'],
                'lines' => $args['lines'],
            ];

            if (isset($args['date'])) {
                $invoice['create_date'] = $args['date'];
            }

            if (isset($args['due_date'])) {
                $invoice['due_date'] = $args['due_date'];
            }

            if (isset($args['invoice_number'])) {
                $invoice['invoice_number'] = $args['invoice_number'];
            }

            if (isset($args['notes'])) {
                $invoice['notes'] = $args['notes'];
            }

            if (isset($args['terms'])) {
                $invoice['terms'] = $args['terms'];
            }

            if (isset($args['discount_value'])) {
                $invoice['discount_value'] = $args['discount_value'];
            }

            if (isset($args['discount_type'])) {
                $invoice['discount_type'] = $args['discount_type'];
            }

            $result = $this->service->createInvoice(['invoice' => $invoice]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
