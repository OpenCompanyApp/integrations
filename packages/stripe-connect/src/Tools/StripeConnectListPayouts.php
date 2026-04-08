<?php

namespace OpenCompany\Integrations\StripeConnect\Tools;

use OpenCompany\Integrations\StripeConnect\StripeConnectService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Stripe Connect payouts with optional filtering.
 *
 * Supports filtering by status and arrival date, and pagination with limit.
 */
class StripeConnectListPayouts implements Tool
{
    /**
     * @param  StripeConnectService  $service  The Stripe Connect API client
     */
    public function __construct(
        private StripeConnectService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_connect_list_payouts';
    }

    public function description(): string
    {
        return <<<'MD'
        List Stripe Connect payouts with optional filtering.
        Supports filtering by status (paid, pending, in_transit, canceled, failed) and arrival date, and pagination with limit.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of payouts to return (1–100, default 10).'],
            'status' => ['type' => 'string', 'description' => 'Filter by payout status: paid, pending, in_transit, canceled, or failed.'],
            'arrival_date' => ['type' => 'string', 'description' => 'Filter by arrival date. A Unix timestamp (e.g., 1712304000), or a hash with "gt", "gte", "lt", "lte" keys.'],
        ];
    }

    /**
     * List Stripe Connect payouts with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, status, arrival_date)
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
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['arrival_date'])) {
                $params['arrival_date'] = $args['arrival_date'];
            }

            $result = $this->service->listPayouts($params);

            $payouts = array_map(function (array $p) {
                return [
                    'id' => $p['id'] ?? '',
                    'amount' => $p['amount'] ?? 0,
                    'currency' => $p['currency'] ?? '',
                    'status' => $p['status'] ?? '',
                    'arrival_date' => $p['arrival_date'] ?? null,
                    'method' => $p['method'] ?? null,
                    'destination' => $p['destination'] ?? null,
                    'created' => $p['created'] ?? null,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'payouts' => $payouts,
                'has_more' => $result['has_more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
