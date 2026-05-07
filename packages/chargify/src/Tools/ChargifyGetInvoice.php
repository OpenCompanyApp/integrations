<?php

namespace OpenCompany\Integrations\Chargify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Chargify\ChargifyService;

/**
 * Get a single invoice by its Maxio Advanced Billing identifier.
 *
 * Supports invoice UID, invoice number, or numeric ID depending on the
 * identifier accepted by the merchant's Advanced Billing site.
 */
class ChargifyGetInvoice implements Tool
{
    /**
     * @param  ChargifyService  $service  The Chargify API client.
     */
    public function __construct(
        private ChargifyService $service,
    ) {}

    public function name(): string
    {
        return 'chargify_get_invoice';
    }

    public function description(): string
    {
        return 'Get detailed information for a single Chargify / Maxio Advanced Billing invoice by ID, UID, or invoice number.';
    }

    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'string', 'required' => true, 'description' => 'The invoice UID, number, or ID.'],
        ];
    }

    /**
     * Get an invoice by identifier through the Chargify API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (invoice_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargify integration is not configured.');
            }

            if (!isset($args['invoice_id']) || $args['invoice_id'] === '') {
                return ToolResult::error('invoice_id is required.');
            }

            $result = $this->service->getInvoice((string) $args['invoice_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
