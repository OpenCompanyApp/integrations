<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * List CoinGecko category IDs.
 */
class CoinGeckoListCategories extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_list_categories';
    }

    public function description(): string
    {
        return 'List CoinGecko category IDs for filtering market data.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->listCategories();
    }
}
