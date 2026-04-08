<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Invoice.
 *
 * Retrieves a single invoice by its ID from Invoice Ninja.
 */
class InvoiceNinjaGetInvoice implements Tool
{
    /**
     * Create a new InvoiceNinjaGetInvoice tool instance.
     */
    public function __construct(
        private InvoiceNinjaService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'invoiceninja_get_invoice';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get a single invoice from Invoice Ninja by ID. Returns full invoice details including line items, client info, and payment status.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The invoice ID.'],
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

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Invoice ID is required.');
            }

            $result = $this->service->getInvoice($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
