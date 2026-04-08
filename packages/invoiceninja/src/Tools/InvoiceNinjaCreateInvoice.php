<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create Invoice.
 *
 * Creates a new invoice in Invoice Ninja with line items and client assignment.
 */
class InvoiceNinjaCreateInvoice implements Tool
{
    /**
     * Create a new InvoiceNinjaCreateInvoice tool instance.
     */
    public function __construct(
        private InvoiceNinjaService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'invoiceninja_create_invoice';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new invoice in Invoice Ninja. Requires a client_id and at least one line item. Supports custom due dates, partial deposits, and notes.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'client_id' => ['type' => 'string', 'required' => true, 'description' => 'The client ID to assign the invoice to.'],
            'line_items' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of line items. Each item should have: product_key (or product_cost), notes, quantity, cost (unit price).',
            ],
            'due_date' => ['type' => 'string', 'description' => 'Due date in YYYY-MM-DD format.'],
            'date' => ['type' => 'string', 'description' => 'Invoice date in YYYY-MM-DD format (defaults to today).'],
            'public_notes' => ['type' => 'string', 'description' => 'Public notes visible to the client.'],
            'private_notes' => ['type' => 'string', 'description' => 'Private notes (internal only).'],
            'discount' => ['type' => 'number', 'description' => 'Discount amount or percentage.'],
            'is_amount_discount' => ['type' => 'boolean', 'description' => 'Whether discount is a fixed amount (true) or percentage (false).'],
            'tax_name1' => ['type' => 'string', 'description' => 'First tax name.'],
            'tax_rate1' => ['type' => 'number', 'description' => 'First tax rate percentage.'],
            'partial' => ['type' => 'number', 'description' => 'Partial/deposit amount.'],
            'partial_due_date' => ['type' => 'string', 'description' => 'Due date for the partial deposit (YYYY-MM-DD).'],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Invoice Ninja integration is not configured.');
            }

            $clientId = $args['client_id'] ?? '';
            if (empty($clientId)) {
                return ToolResult::error('client_id is required.');
            }

            $lineItems = $args['line_items'] ?? [];
            if (empty($lineItems)) {
                return ToolResult::error('At least one line item is required.');
            }

            $data = array_filter([
                'client_id' => $clientId,
                'line_items' => $lineItems,
                'due_date' => $args['due_date'] ?? null,
                'date' => $args['date'] ?? null,
                'public_notes' => $args['public_notes'] ?? null,
                'private_notes' => $args['private_notes'] ?? null,
                'discount' => $args['discount'] ?? null,
                'is_amount_discount' => $args['is_amount_discount'] ?? null,
                'tax_name1' => $args['tax_name1'] ?? null,
                'tax_rate1' => $args['tax_rate1'] ?? null,
                'partial' => $args['partial'] ?? null,
                'partial_due_date' => $args['partial_due_date'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->createInvoice($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
