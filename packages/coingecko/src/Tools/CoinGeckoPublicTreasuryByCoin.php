<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Query public treasury holdings by companies or governments for a coin.
 */
class CoinGeckoPublicTreasuryByCoin extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_public_treasury_by_coin';
    }

    public function description(): string
    {
        return 'Get public company or government crypto treasury holdings by CoinGecko coin ID.';
    }

    public function parameters(): array
    {
        return [
            'entity' => ['type' => 'string', 'required' => true, 'description' => 'companies or governments.'],
            'coin_id' => ['type' => 'string', 'required' => true, 'description' => 'CoinGecko coin ID, such as bitcoin.'],
            'params' => ['type' => 'object', 'description' => 'Optional query parameters: per_page, page, order.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getPublicTreasuryByCoin(
            $this->stringArg($args, 'entity'),
            $this->stringArg($args, 'coin_id'),
            $this->optionalParams($args),
        );
    }
}
