<?php

namespace OpenCompany\Integrations\ZohoBills\Tools;

use OpenCompany\Integrations\ZohoBills\ZohoBillsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoBillsGetInvoice implements Tool
{
    public function __construct(
        private ZohoBillsService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_bills_get_invoice';
    }

    public function description(): string
    {
        return 'Retrieve a single invoice from Zoho Bills by its ID. Returns full invoice details including line items, totals, and status.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The invoice ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Bills integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Invoice ID is required.');
            }

            $result = $this->service->getInvoice($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
