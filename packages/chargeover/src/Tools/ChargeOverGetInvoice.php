<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChargeOverGetInvoice implements Tool
{
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_get_invoice';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific ChargeOver invoice by ID, including line items, totals, tax, applied payments, and invoice URL.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The invoice ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Invoice ID is required.');
            }

            $result = $this->service->getInvoice((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
