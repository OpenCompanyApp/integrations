<?php

namespace OpenCompany\Integrations\FreeAgent\Tools;

use OpenCompany\Integrations\FreeAgent\FreeAgentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new invoice in FreeAgent.
 */
class FreeAgentCreateInvoice implements Tool
{
    /**
     * Create a new FreeAgentCreateInvoice tool instance.
     *
     * @param  FreeAgentService  $service  The FreeAgent service for making API calls.
     */
    public function __construct(
        private FreeAgentService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freeagent_create_invoice';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new invoice in FreeAgent. Requires a contact and at least one line item. Supports setting due date, currency, invoice items with quantities and prices, and comments.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'contact' => ['type' => 'string', 'required' => true, 'description' => 'The contact URL or ID for the invoice recipient (e.g., "https://api.freeagent.com/v2/contacts/123").'],
            'dated_on' => ['type' => 'string', 'required' => true, 'description' => 'The invoice date (ISO 8601, e.g., "2025-01-15").'],
            'invoice_items' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items, each with "description", "quantity", and "price". Optionally include "sales_tax_rate".'],
            'due_on' => ['type' => 'string', 'description' => 'The due date (ISO 8601). If omitted, FreeAgent calculates based on contact terms.'],
            'reference' => ['type' => 'string', 'description' => 'A reference number for the invoice.'],
            'currency' => ['type' => 'string', 'description' => 'Currency code (e.g., "GBP", "USD", "EUR"). Defaults to the company currency.'],
            'comments' => ['type' => 'string', 'description' => 'Comments or notes to include on the invoice.'],
            'project' => ['type' => 'string', 'description' => 'The project URL to associate the invoice with.'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result of the tool execution.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('FreeAgent integration is not configured.');
            }

            $data = [
                'contact' => $args['contact'],
                'dated_on' => $args['dated_on'],
                'invoice_items' => $args['invoice_items'],
            ];

            $optional = ['due_on', 'reference', 'currency', 'comments', 'project'];
            foreach ($optional as $key) {
                if (isset($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }

            $result = $this->service->createInvoice($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
