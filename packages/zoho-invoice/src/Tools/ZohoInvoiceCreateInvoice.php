<?php

namespace OpenCompany\Integrations\ZohoInvoice\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ZohoInvoice\ZohoInvoiceService;

/**
 * Create a new invoice in Zoho Invoice.
 */
class ZohoInvoiceCreateInvoice implements Tool
{
    /**
     * @param  ZohoInvoiceService  $service  The Zoho Invoice API service instance
     */
    public function __construct(
        private ZohoInvoiceService $service,
    ) {}

    public function name(): string
    {
        return 'zohoinvoice_create_invoice';
    }

    public function description(): string
    {
        return 'Create a new invoice in Zoho Invoice. Requires at minimum a customer_id and one line item. Returns the created invoice with its ID and total.';
    }

    public function parameters(): array
    {
        return [
            'customer_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The contact ID of the customer to invoice.',
            ],
            'line_items' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of line items. Each item should have "item_id" or "name" and "rate" and "quantity".',
                'items' => ['type' => 'object'],
            ],
            'invoice_number' => [
                'type' => 'string',
                'description' => 'Custom invoice number (auto-generated if omitted).',
            ],
            'date' => [
                'type' => 'string',
                'description' => 'Invoice date (ISO 8601, e.g., "2025-01-15"). Defaults to today.',
            ],
            'due_date' => [
                'type' => 'string',
                'description' => 'Payment due date (ISO 8601, e.g., "2025-02-15").',
            ],
            'notes' => [
                'type' => 'string',
                'description' => 'Notes to display on the invoice.',
            ],
            'terms' => [
                'type' => 'string',
                'description' => 'Terms and conditions for the invoice.',
            ],
            'reference_number' => [
                'type' => 'string',
                'description' => 'Reference number for internal tracking.',
            ],
        ];
    }

    /**
     * Execute the create invoice tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Invoice integration is not configured.');
            }

            $customerId = $args['customer_id'] ?? '';
            if (empty($customerId)) {
                return ToolResult::error('customer_id is required.');
            }

            $lineItems = $args['line_items'] ?? [];
            if (empty($lineItems)) {
                return ToolResult::error('At least one line item is required.');
            }

            $data = [
                'customer_id' => $customerId,
                'line_items' => $lineItems,
            ];

            if (isset($args['invoice_number'])) {
                $data['invoice_number'] = $args['invoice_number'];
            }
            if (isset($args['date'])) {
                $data['date'] = $args['date'];
            }
            if (isset($args['due_date'])) {
                $data['due_date'] = $args['due_date'];
            }
            if (isset($args['notes'])) {
                $data['notes'] = $args['notes'];
            }
            if (isset($args['terms'])) {
                $data['terms'] = $args['terms'];
            }
            if (isset($args['reference_number'])) {
                $data['reference_number'] = $args['reference_number'];
            }

            $result = $this->service->createInvoice($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
