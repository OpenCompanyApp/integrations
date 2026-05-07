<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * List CoinGecko exchange IDs and names.
 */
class CoinGeckoListExchangeIds extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_list_exchange_ids';
    }

    public function description(): string
    {
        return 'List exchange IDs and names for exchange-specific tools.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->listExchangeIds();
    }
}
