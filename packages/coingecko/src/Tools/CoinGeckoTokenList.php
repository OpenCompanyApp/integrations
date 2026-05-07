<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Retrieve an Ethereum token-list compatible asset-platform token list.
 */
class CoinGeckoTokenList extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_token_list';
    }

    public function description(): string
    {
        return 'Get the token list for an asset platform, such as ethereum or polygon-pos.';
    }

    public function parameters(): array
    {
        return [
            'asset_platform_id' => ['type' => 'string', 'required' => true, 'description' => 'Asset platform ID.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getTokenList($this->stringArg($args, 'asset_platform_id'));
    }
}
