<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Airdrop.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/cryptocurrency/airdrop.
 */
class CoinMarketCapGetV1CryptocurrencyAirdrop extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_cryptocurrency_airdrop';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/airdrop.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Airdrop Unique ID. This can be found using the Airdrops API.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/cryptocurrency/airdrop';
    protected const QUERY_PARAMS = [
        'id' => 'id',
    ];
    protected const BODY_REQUIRED = false;
}
