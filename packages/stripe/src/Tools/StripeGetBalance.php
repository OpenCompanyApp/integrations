<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the Stripe account balance.
 *
 * Returns available and pending balances with amounts per currency.
 */
class StripeGetBalance implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_get_balance';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the Stripe account balance.
        Returns available and pending balances with amounts per currency.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the Stripe account balance with available and pending amounts.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $balance = $this->service->getBalance();

            $available = array_map(function (array $a) {
                return [
                    'amount' => $a['amount'] ?? 0,
                    'currency' => $a['currency'] ?? '',
                ];
            }, $balance['available'] ?? []);

            $pending = array_map(function (array $p) {
                return [
                    'amount' => $p['amount'] ?? 0,
                    'currency' => $p['currency'] ?? '',
                ];
            }, $balance['pending'] ?? []);

            return ToolResult::success([
                'available' => $available,
                'pending' => $pending,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
