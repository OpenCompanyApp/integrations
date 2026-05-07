<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Get current prices for one or more token contract addresses.
 */
class CoinGeckoSimpleTokenPrice extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_simple_token_price';
    }

    public function description(): string
    {
        return 'Get token prices by asset platform ID and token contract address.';
    }

    public function parameters(): array
    {
        return [
            'asset_platform_id' => ['type' => 'string', 'required' => true, 'description' => 'Asset platform ID such as ethereum, polygon-pos, or solana.'],
            'contract_addresses' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated token contract addresses.'],
            'currencies' => ['type' => 'string', 'description' => 'Comma-separated target currencies, default usd.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getSimpleTokenPrice(
            $this->stringArg($args, 'asset_platform_id'),
            $this->stringListArg($args, 'contract_addresses'),
            $this->stringListArg($args, 'currencies', 'usd'),
            [
                'include_market_cap' => true,
                'include_24hr_vol' => true,
                'include_24hr_change' => true,
                'include_last_updated_at' => true,
            ],
        );
    }
}
