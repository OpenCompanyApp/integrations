<?php

namespace OpenCompany\Integrations\ZohoBills\Tools;

use OpenCompany\Integrations\ZohoBills\ZohoBillsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoBillsCreateInvoice implements Tool
{
    public function __construct(
        private ZohoBillsService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_bills_create_invoice';
    }

    public function description(): string
    {
        return 'Create a new invoice in Zoho Bills. Provide a customer ID, line items, and optional date/due date. Each line item should include item_id or a name, plus rate and quantity.';
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'The customer ID to bill.'],
            'line_items' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items. Each item should have item_id (or name/description), rate, and quantity. Example: [{"item_id": "...", "quantity": 2, "rate": 50.00}]'],
            'date' => ['type' => 'string', 'description' => 'Invoice date in YYYY-MM-DD format. Defaults to today.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date in YYYY-MM-DD format.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Bills integration is not configured.');
            }

            if (empty($args['customer_id'])) {
                return ToolResult::error('customer_id is required.');
            }

            if (empty($args['line_items']) || !is_array($args['line_items'])) {
                return ToolResult::error('line_items must be a non-empty array.');
            }

            $result = $this->service->createInvoice(
                customerId: $args['customer_id'],
                lineItems: $args['line_items'],
                date: $args['date'] ?? null,
                dueDate: $args['due_date'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
