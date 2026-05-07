<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Retrieve global decentralized finance market statistics.
 */
class CoinGeckoGlobalDefi extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_global_defi';
    }

    public function description(): string
    {
        return 'Get global DeFi market cap, volume, dominance, and related aggregate metrics.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->getGlobalDefi();
    }
}
