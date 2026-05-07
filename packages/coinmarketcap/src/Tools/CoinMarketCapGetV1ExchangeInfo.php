<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Metadata.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/exchange/info.
 */
class CoinMarketCapGetV1ExchangeInfo extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_exchange_info';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/info.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated CoinMarketCap cryptocurrency exchange ids. Example: "1,2"',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively, one or more comma-separated exchange names in URL friendly shorthand "slug" format (all lowercase, spaces replaced with hyphens). Example: "binance,gdax". At least one "id" *or* "slug" is required.',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `urls,logo,description,date_launched,notice,status` to include all auxiliary fields.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/exchange/info';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'aux' => 'aux',
    ];
    protected const BODY_REQUIRED = false;
}
