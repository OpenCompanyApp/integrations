<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Query historical volume chart data for an exchange.
 */
class CoinGeckoExchangeVolumeChart extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_exchange_volume_chart';
    }

    public function description(): string
    {
        return 'Get historical exchange volume chart data in BTC.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'CoinGecko exchange ID.'],
            'days' => ['type' => 'string', 'description' => 'Number of days, default 30.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getExchangeVolumeChart($this->stringArg($args, 'id'), (int) ($args['days'] ?? 30));
    }
}
