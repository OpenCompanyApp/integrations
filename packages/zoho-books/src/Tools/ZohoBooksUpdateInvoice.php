<?php

namespace OpenCompany\Integrations\ZohoBooks\Tools;

use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohobooks_update_invoice
 *
 * Updates an existing invoice in Zoho Books. Only the fields provided
 * in the arguments will be modified.
 */
class ZohoBooksUpdateInvoice implements Tool
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
        return 'zohobooks_update_invoice';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Update an existing invoice in Zoho Books. Provide the invoice_id and any fields to change (line_items, dates, notes, status, etc.).';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the invoice to update.'],
            'customer_id' => ['type' => 'string', 'description' => 'Change the customer (contact) ID on the invoice.'],
            'line_items' => ['type' => 'array', 'description' => 'Replace all line items. Each item should have: item_id (or name), rate, quantity.'],
            'date' => ['type' => 'string', 'description' => 'Invoice date (ISO 8601).'],
            'due_date' => ['type' => 'string', 'description' => 'Due date for payment (ISO 8601).'],
            'notes' => ['type' => 'string', 'description' => 'Notes displayed on the invoice.'],
            'terms' => ['type' => 'string', 'description' => 'Terms and conditions.'],
            'status' => ['type' => 'string', 'description' => 'Update invoice status: draft, sent, voided.'],
            'reference_number' => ['type' => 'string', 'description' => 'Reference number (e.g., PO number).'],
        ];
    }

    /**
     * Execute the tool call — update an invoice in Zoho Books.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Books integration is not configured. Provide an access token and organization ID.');
            }

            $invoiceId = $args['invoice_id'] ?? '';
            if (empty($invoiceId)) {
                return ToolResult::error('invoice_id is required.');
            }

            $data = [];
            $updatableFields = ['customer_id', 'line_items', 'date', 'due_date', 'notes', 'terms', 'status', 'reference_number'];
            foreach ($updatableFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            if (empty($data)) {
                return ToolResult::error('No fields provided to update. Specify at least one field to change.');
            }

            $result = $this->service->updateInvoice($invoiceId, $data);
            $invoice = $result['invoice'] ?? $result;

            return ToolResult::success([
                'message' => 'Invoice updated successfully.',
                'invoice' => $invoice,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
