<?php

namespace OpenCompany\Integrations\FreshBooks\Tools;

use OpenCompany\Integrations\FreshBooks\FreshBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshBooksGetInvoice implements Tool
{
    public function __construct(
        private FreshBooksService $service,
    ) {}

    public function name(): string
    {
        return 'freshbooks_get_invoice';
    }

    public function description(): string
    {
        return 'Get details of a specific FreshBooks invoice by ID. Returns full invoice data including line items, amounts, client details, status, and payment info.';
    }

    public function parameters(): array
    {
        return [
            'invoice_id' => ['type' => 'integer', 'required' => true, 'description' => 'The FreshBooks invoice ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('FreshBooks integration is not configured. Please provide an access token and account ID.');
            }

            if (empty($args['invoice_id'])) {
                return ToolResult::error('invoice_id is required.');
            }

            $result = $this->service->getInvoice((int) $args['invoice_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
