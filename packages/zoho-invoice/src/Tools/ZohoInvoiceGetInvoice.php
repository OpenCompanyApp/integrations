<?php

namespace OpenCompany\Integrations\ZohoInvoice\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ZohoInvoice\ZohoInvoiceService;

/**
 * Get full details of a single Zoho Invoice by ID.
 */
class ZohoInvoiceGetInvoice implements Tool
{
    /**
     * @param  ZohoInvoiceService  $service  The Zoho Invoice API service instance
     */
    public function __construct(
        private ZohoInvoiceService $service,
    ) {}

    public function name(): string
    {
        return 'zohoinvoice_get_invoice';
    }

    public function description(): string
    {
        return 'Get full details of a single invoice by its ID, including line items, totals, payments, and notes.';
    }

    public function parameters(): array
    {
        return [
            'invoice_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The unique ID of the invoice.',
            ],
        ];
    }

    /**
     * Execute the get invoice tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Invoice integration is not configured.');
            }

            $invoiceId = $args['invoice_id'] ?? '';
            if (empty($invoiceId)) {
                return ToolResult::error('invoice_id is required.');
            }

            $result = $this->service->getInvoice($invoiceId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
