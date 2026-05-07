<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Query exchange tickers for a CoinGecko coin.
 */
class CoinGeckoCoinTickers extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_coin_tickers';
    }

    public function description(): string
    {
        return 'Get centralized and decentralized exchange tickers for a CoinGecko coin ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'CoinGecko coin ID.'],
            'params' => ['type' => 'object', 'description' => 'Optional query parameters such as exchange_ids, page, depth, order.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getCoinTickers($this->stringArg($args, 'id'), $this->optionalParams($args));
    }
}
