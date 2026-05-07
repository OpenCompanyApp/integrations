<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * FCAS Listings Latest (deprecated).
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/partners/flipside-crypto/fcas/listings/latest.
 */
class CoinMarketCapGetV1PartnersFlipsideCryptoFcasListingsLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_partners_flipside_crypto_fcas_listings_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/partners/flipside-crypto/fcas/listings/latest.';
    protected const PARAMETERS = [
        'start' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `point_change_24h,percent_change_24h` to include all auxiliary fields.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/partners/flipside-crypto/fcas/listings/latest';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'aux' => 'aux',
    ];
    protected const BODY_REQUIRED = false;
}
