<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

/**
 * Call a read-only CoinGecko API v3 endpoint.
 */
class CoinGeckoApiGet extends AbstractCoinGeckoTool
{
    public function name(): string
    {
        return 'coingecko_api_get';
    }

    public function description(): string
    {
        return 'Call any CoinGecko API v3 GET path not covered by a first-class tool, such as /derivatives or /nfts/list.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'CoinGecko API path, such as /derivatives or /nfts/list.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->apiGet($this->stringArg($args, 'path'), $this->optionalParams($args));
    }
}
