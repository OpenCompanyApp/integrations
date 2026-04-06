<?php

namespace OpenCompany\Integrations\StripeConnect\Tools;

use OpenCompany\Integrations\StripeConnect\StripeConnectService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Stripe Connect balance transactions.
 *
 * Returns a paginated list of balance transactions with type, amount, currency, and description.
 */
class StripeConnectListBalances implements Tool
{
    /**
     * @param  StripeConnectService  $service  The Stripe Connect API client
     */
    public function __construct(
        private StripeConnectService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_connect_list_balances';
    }

    public function description(): string
    {
        return <<<'MD'
        List Stripe Connect balance transactions.
        Returns a paginated list of balance transactions with type, amount, currency, and description.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of balance transactions to return (1–100, default 10).'],
        ];
    }

    /**
     * List Stripe Connect balance transactions with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe Connect integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listBalanceTransactions($params);

            $transactions = array_map(function (array $t) {
                return [
                    'id' => $t['id'] ?? '',
                    'type' => $t['type'] ?? '',
                    'amount' => $t['amount'] ?? 0,
                    'currency' => $t['currency'] ?? '',
                    'net' => $t['net'] ?? 0,
                    'fee' => $t['fee'] ?? 0,
                    'description' => $t['description'] ?? null,
                    'status' => $t['status'] ?? '',
                    'created' => $t['created'] ?? null,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'balance_transactions' => $transactions,
                'has_more' => $result['has_more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
