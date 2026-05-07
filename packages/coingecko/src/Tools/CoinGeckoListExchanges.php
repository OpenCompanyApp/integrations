<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * List active exchanges with CoinGecko volume and trust-score data.
 */
class CoinGeckoListExchanges extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_list_exchanges';
    }

    public function description(): string
    {
        return 'List active exchanges with country, trust score, and 24-hour BTC volume data.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional query parameters: per_page, page.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listExchanges($this->optionalParams($args));
    }
}
