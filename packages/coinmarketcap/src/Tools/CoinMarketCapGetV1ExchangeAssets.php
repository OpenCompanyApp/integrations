<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Exchange Assets.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/exchange/assets.
 */
class CoinMarketCapGetV1ExchangeAssets extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_exchange_assets';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/assets.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A CoinMarketCap exchange ID. Example: 270',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/exchange/assets';
    protected const QUERY_PARAMS = [
        'id' => 'id',
    ];
    protected const BODY_REQUIRED = false;
}
