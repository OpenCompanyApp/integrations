<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * List recently added CoinGecko coins.
 */
class CoinGeckoNewCoins extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_new_coins';
    }

    public function description(): string
    {
        return 'List the latest coins recently added to CoinGecko.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->listNewCoins();
    }
}
