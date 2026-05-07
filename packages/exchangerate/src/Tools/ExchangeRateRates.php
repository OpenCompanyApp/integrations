<?php

namespace OpenCompany\Integrations\ExchangeRate\Tools;

use OpenCompany\Integrations\ExchangeRate\ExchangeRateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch all exchange rates for one base currency.
 */
class ExchangeRateRates implements Tool
{
    /**
     * @param  ExchangeRateService  $service  The exchange-rate API client.
     */
    public function __construct(
        private ExchangeRateService $service,
    ) {}

    public function name(): string
    {
        return 'exchangerate_rates';
    }

    public function description(): string
    {
        return 'Get all exchange rates for a base currency. Optionally filter to specific target currencies. Supports 340 fiat currencies, cryptocurrencies, and precious metals.';
    }

    public function parameters(): array
    {
        return [
            'base' => ['type' => 'string', 'required' => true, 'description' => 'Base currency code (e.g. "usd", "btc").'],
            'date' => ['type' => 'string', 'description' => 'Date for rates (default: "latest"). Format: "YYYY-MM-DD" or "latest".'],
            'currencies' => ['type' => 'string', 'description' => 'Comma-separated currency codes to filter (e.g. "eur,gbp,jpy"). Shows popular currencies if omitted.'],
        ];
    }

    /**
     * Fetch and optionally filter base-currency rates.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base, date, currencies).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $base = $args['base'] ?? $args['from'] ?? null;

            if (! $base) {
                return ToolResult::error('base currency code is required (e.g. "usd", "btc").');
            }

            $date = $args['date'] ?? 'latest';
            $result = $this->service->getRates($base, $date);

            $rates = $result['rates'];

            $filter = $args['currencies'] ?? null;
            if ($filter) {
                $codes = array_map('trim', array_map('strtolower', explode(',', $filter)));
                $rates = array_intersect_key($rates, array_flip($codes));
            }

            $total = count($rates);
            if (! $filter && $total > 50) {
                $popular = array_intersect_key($rates, ExchangeRateService::POPULAR_CURRENCIES);
                $rates = $popular;
            }

            return ToolResult::success([
                'base' => strtolower($base),
                'date' => $result['date'],
                'total_available' => count($result['rates']),
                'showing' => count($rates),
                'rates' => $rates,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
