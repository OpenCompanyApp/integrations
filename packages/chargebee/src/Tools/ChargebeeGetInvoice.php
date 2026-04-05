<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single invoice from Chargebee by ID.
 */
class ChargebeeGetInvoice implements Tool
{
    /**
     * Create a new ChargebeeGetInvoice tool instance.
     *
     * @param  ChargebeeService  $service  The Chargebee API service.
     */
    public function __construct(
        private ChargebeeService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'chargebee_get_invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Retrieve detailed information about a specific Chargebee invoice by its ID, including line items, totals, tax, and payment status.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The invoice ID.'],
        ];
    }

    /**
     * Execute the get invoice request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargebee integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Invoice ID is required.');
            }

            $result = $this->service->getInvoice($args['id']);

            $invoice = $result['invoice'] ?? $result;

            return ToolResult::success(['invoice' => $invoice]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
