<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Retrieve BTC exchange rates for fiat and cryptocurrency units.
 */
class CoinGeckoExchangeRates extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_exchange_rates';
    }

    public function description(): string
    {
        return 'Get BTC-to-currency exchange rates for fiat and crypto units.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->getExchangeRates();
    }
}
