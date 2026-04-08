<?php

namespace OpenCompany\Integrations\Avalara\Tools;

use OpenCompany\Integrations\Avalara\AvalaraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AvalaraCreateTransaction implements Tool
{
    public function __construct(
        private AvalaraService $service,
    ) {}

    public function name(): string { return 'avalara_create_transaction'; }

    public function description(): string
    {
        return 'Create a new transaction (sales order or invoice) in Avalara for tax calculation. Requires company code, transaction type, date, and line items.';
    }

    public function parameters(): array
    {
        return [
            'companyCode' => ['type' => 'string', 'required' => true, 'description' => 'The company code for the transaction.'],
            'type' => ['type' => 'string', 'description' => 'Transaction type: "SalesOrder" or "SalesInvoice" (default "SalesOrder").'],
            'date' => ['type' => 'string', 'description' => 'Transaction date in YYYY-MM-DD format. Defaults to today.'],
            'code' => ['type' => 'string', 'description' => 'A unique reference code for this transaction.'],
            'customerCode' => ['type' => 'string', 'description' => 'The customer code for the transaction.'],
            'lines' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items. Each line should include "amount", "quantity", and optionally "taxCode", "description".'],
            'addresses' => ['type' => 'object', 'description' => 'Address information for tax calculation, including "shipFrom" and "shipTo" with "city", "region", "country", "postalCode".'],
            'commit' => ['type' => 'boolean', 'description' => 'Whether to commit the transaction immediately (default false).'],
            'description' => ['type' => 'string', 'description' => 'Description of the transaction.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Avalara integration is not configured.');
            }

            $companyCode = $args['companyCode'] ?? '';
            if (empty($companyCode)) {
                return ToolResult::error('Company code is required.');
            }

            $lines = $args['lines'] ?? [];
            if (empty($lines)) {
                return ToolResult::error('At least one line item is required.');
            }

            $body = [
                'companyCode' => $companyCode,
                'lines' => $lines,
            ];

            if (isset($args['type'])) { $body['type'] = $args['type']; }
            if (isset($args['date'])) { $body['date'] = $args['date']; }
            if (isset($args['code'])) { $body['code'] = $args['code']; }
            if (isset($args['customerCode'])) { $body['customerCode'] = $args['customerCode']; }
            if (isset($args['addresses'])) { $body['addresses'] = $args['addresses']; }
            if (isset($args['commit'])) { $body['commit'] = $args['commit']; }
            if (isset($args['description'])) { $body['description'] = $args['description']; }

            $result = $this->service->createTransaction($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
