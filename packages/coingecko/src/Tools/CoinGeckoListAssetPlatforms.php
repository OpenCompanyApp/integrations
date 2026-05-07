<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * List CoinGecko asset platform IDs.
 */
class CoinGeckoListAssetPlatforms extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_list_asset_platforms';
    }

    public function description(): string
    {
        return 'List asset platform IDs and chain metadata used by token-price and token-list endpoints.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional query parameters such as filter=nft.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listAssetPlatforms($this->optionalParams($args));
    }
}
