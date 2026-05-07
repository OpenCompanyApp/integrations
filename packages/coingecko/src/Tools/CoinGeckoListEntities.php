<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * List public treasury entity IDs.
 */
class CoinGeckoListEntities extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_list_entities';
    }

    public function description(): string
    {
        return 'List public companies and governments supported by CoinGecko public treasury endpoints.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->listEntities();
    }
}
