<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Retrieve full CoinGecko exchange data by ID.
 */
class CoinGeckoGetExchange extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_get_exchange';
    }

    public function description(): string
    {
        return 'Get exchange profile data, volume, and tickers by CoinGecko exchange ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'CoinGecko exchange ID such as binance or gdax.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getExchange($this->stringArg($args, 'id'));
    }
}
