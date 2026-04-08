<?php

namespace OpenCompany\Integrations\Braintree\Tools;

use OpenCompany\Integrations\Braintree\BraintreeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BraintreeListTransactions implements Tool
{
    public function __construct(
        private BraintreeService $service,
    ) {}

    public function name(): string
    {
        return 'braintree_list_transactions';
    }

    public function description(): string
    {
        return 'List payment transactions for the Braintree merchant. Returns transaction details including amount, status, payment method, and customer info.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of transactions to return (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by transaction status: authorized, submitted_for_settlement, settled, settling, failed, voided, declined, gateway_rejected.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braintree integration is not configured. Missing access token or merchant ID.');
            }

            $limit = isset($args['limit']) ? min((int) $args['limit'], 100) : 10;
            $page = isset($args['page']) ? max((int) $args['page'], 1) : 1;
            $status = $args['status'] ?? null;

            $result = $this->service->listTransactions($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
