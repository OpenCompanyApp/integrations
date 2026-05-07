<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Get historical CoinGecko metadata for a specific date.
 */
class CoinGeckoCoinHistoryDate extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_coin_history_date';
    }

    public function description(): string
    {
        return 'Get historical coin data for a calendar date in dd-mm-yyyy format.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'CoinGecko coin ID.'],
            'date' => ['type' => 'string', 'required' => true, 'description' => 'Date in dd-mm-yyyy format.'],
            'params' => ['type' => 'object', 'description' => 'Optional query parameters such as localization.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getCoinHistory($this->stringArg($args, 'id'), $this->stringArg($args, 'date'), $this->optionalParams($args));
    }
}
