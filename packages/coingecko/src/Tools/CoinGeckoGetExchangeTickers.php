<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Query tickers for a CoinGecko exchange.
 */
class CoinGeckoGetExchangeTickers extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_get_exchange_tickers';
    }

    public function description(): string
    {
        return 'Get market tickers for a CoinGecko exchange ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'CoinGecko exchange ID.'],
            'params' => ['type' => 'object', 'description' => 'Optional query parameters such as coin_ids, page, depth, order.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getExchangeTickers($this->stringArg($args, 'id'), $this->optionalParams($args));
    }
}
