<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * List CoinGecko categories with market data.
 */
class CoinGeckoCategoriesMarketData extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_categories_market_data';
    }

    public function description(): string
    {
        return 'List CoinGecko categories with market cap, volume, and top coin data.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional query parameters such as order.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listCategoriesWithMarketData($this->optionalParams($args));
    }
}
