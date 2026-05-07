<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * FCAS Quotes Latest (deprecated).
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/partners/flipside-crypto/fcas/quotes/latest.
 */
class CoinMarketCapGetV1PartnersFlipsideCryptoFcasQuotesLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_partners_flipside_crypto_fcas_quotes_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/partners/flipside-crypto/fcas/quotes/latest.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request.',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `point_change_24h,percent_change_24h` to include all auxiliary fields.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/partners/flipside-crypto/fcas/quotes/latest';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
        'aux' => 'aux',
    ];
    protected const BODY_REQUIRED = false;
}
