<?php

namespace OpenCompany\Integrations\ZohoBooks\Tools;

use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohobooks_create_invoice
 *
 * Creates a new invoice in Zoho Books. Requires a customer_id and at least
 * one line item. Supports custom dates, notes, terms, and more.
 */
class ZohoBooksCreateInvoice implements Tool
{
    /**
     * @param  ZohoBooksService  $service  The Zoho Books API service instance.
     */
    public function __construct(
        private ZohoBooksService $service,
    ) {}

    /**
     * The tool identifier used by the AI agent runtime.
     */
    public function name(): string
    {
        return 'zohobooks_create_invoice';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new invoice in Zoho Books. Requires a customer_id and line_items array. Each line item needs at least an item_id or name with a rate and quantity.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'The customer (contact) ID to invoice.'],
            'line_items' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items. Each item should have: item_id (or name), rate, quantity, and optionally description.'],
            'date' => ['type' => 'string', 'description' => 'Invoice date (ISO 8601, e.g., "2025-01-15"). Defaults to today.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date for payment (ISO 8601).'],
            'invoice_number' => ['type' => 'string', 'description' => 'Custom invoice number. Auto-generated if omitted.'],
            'reference_number' => ['type' => 'string', 'description' => 'Reference number (e.g., PO number).'],
            'notes' => ['type' => 'string', 'description' => 'Notes to display on the invoice.'],
            'terms' => ['type' => 'string', 'description' => 'Terms and conditions.'],
        ];
    }

    /**
     * Execute the tool call — create an invoice in Zoho Books.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Books integration is not configured. Provide an access token and organization ID.');
            }

            $customerId = $args['customer_id'] ?? '';
            $lineItems = $args['line_items'] ?? [];

            if (empty($customerId)) {
                return ToolResult::error('customer_id is required to create an invoice.');
            }

            if (empty($lineItems)) {
                return ToolResult::error('line_items is required to create an invoice. Provide at least one line item.');
            }

            $data = [
                'customer_id' => $customerId,
                'line_items' => $lineItems,
            ];

            $optionalFields = ['date', 'due_date', 'invoice_number', 'reference_number', 'notes', 'terms'];
            foreach ($optionalFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            $result = $this->service->createInvoice($data);
            $invoice = $result['invoice'] ?? $result;

            return ToolResult::success([
                'message' => 'Invoice created successfully.',
                'invoice' => $invoice,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
