<?php

namespace OpenCompany\Integrations\ZohoBooks\Tools;

use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohobooks_get_invoice
 *
 * Retrieves full details of a specific invoice by its ID, including
 * line items, taxes, payments, and credits applied.
 */
class ZohoBooksGetInvoice implements Tool
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
        return 'zohobooks_get_invoice';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get full details of a specific invoice in Zoho Books by its ID, including line items, totals, payments, and credits.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the invoice to retrieve.'],
        ];
    }

    /**
     * Execute the tool call — get a single invoice from Zoho Books.
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

            $result = $this->service->getInvoice($invoiceId);
            $invoice = $result['invoice'] ?? $result;

            return ToolResult::success($invoice);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
