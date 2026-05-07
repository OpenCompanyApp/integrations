<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Query public treasury holdings by entity ID.
 */
class CoinGeckoPublicTreasuryEntity extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_public_treasury_entity';
    }

    public function description(): string
    {
        return 'Get public treasury holdings for a public company or government entity ID.';
    }

    public function parameters(): array
    {
        return [
            'entity_id' => ['type' => 'string', 'required' => true, 'description' => 'Public treasury entity ID from coingecko_list_entities.'],
            'params' => ['type' => 'object', 'description' => 'Optional holding_amount_change and holding_change_percentage query parameters.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getPublicTreasuryEntity($this->stringArg($args, 'entity_id'), $this->optionalParams($args));
    }
}
