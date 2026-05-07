<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * List CoinGecko coin IDs for downstream price and market tools.
 */
class CoinGeckoListCoins extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_list_coins';
    }

    public function description(): string
    {
        return 'List supported CoinGecko coin IDs, symbols, names, and optional asset-platform contract addresses.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional query parameters: include_platform, status.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listCoins($this->optionalParams($args));
    }
}
