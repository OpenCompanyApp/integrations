<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Query CoinGecko's top price gainers and losers endpoint.
 */
class CoinGeckoTopGainersLosers extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_top_gainers_losers';
    }

    public function description(): string
    {
        return 'Get top gainers and losers for a target currency and time duration.';
    }

    public function parameters(): array
    {
        return [
            'currency' => ['type' => 'string', 'description' => 'Target currency, default usd.'],
            'params' => ['type' => 'object', 'description' => 'Optional query parameters such as duration and top_coins.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getTopGainersLosers((string) ($args['currency'] ?? 'usd'), $this->optionalParams($args));
    }
}
