<?php

namespace OpenCompany\Integrations\ExchangeRate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ExchangeRate\ExchangeRateService;

/**
 * Fetch a direct exchange rate for one currency pair.
 *
 * Uses the upstream pair endpoint instead of downloading every target rate for the base currency.
 */
class ExchangeRatePairRate implements Tool
{
    /**
     * @param  ExchangeRateService  $service  The exchange-rate API client.
     */
    public function __construct(
        private ExchangeRateService $service,
    ) {}

    public function name(): string
    {
        return 'exchangerate_pair_rate';
    }

    public function description(): string
    {
        return 'Get the direct exchange rate for one currency pair using the upstream pair endpoint. Supports latest and historical dates.';
    }

    public function parameters(): array
    {
        return [
            'from' => ['type' => 'string', 'required' => true, 'description' => 'Source currency code (e.g. "usd", "btc", "xau").'],
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Target currency code (e.g. "eur", "jpy").'],
            'date' => ['type' => 'string', 'description' => 'Date for the rate (default: "latest"). Format: "YYYY-MM-DD" or "latest".'],
        ];
    }

    /**
     * Get a direct currency-pair rate.
     *
     * @param  array<string, mixed>  $args  Tool arguments (from, to, date).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $from = $args['from'] ?? null;
            $to = $args['to'] ?? null;

            if (! $from || ! $to) {
                return ToolResult::error('Both "from" and "to" currency codes are required.');
            }

            $result = $this->service->getPairRate($from, $to, $args['date'] ?? 'latest');

            if ($result['rate'] === null) {
                return ToolResult::error("Exchange rate not found for {$result['from']} -> {$result['to']}.");
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
