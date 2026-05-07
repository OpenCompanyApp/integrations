<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Cryptocurrency Quotes Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v3/cryptocurrency/quotes/latest.
 */
class CoinMarketCapGetV3CryptocurrencyQuotesLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v3_cryptocurrency_quotes_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/cryptocurrency/quotes/latest.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs.',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs.',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols.',
        ],
        'convert' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol.',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields to return.',
        ],
        'skip_invalid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pass true to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if no match is found for 1 or more requested cryptocurrencies. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/cryptocurrency/quotes/latest';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
        'aux' => 'aux',
        'skip_invalid' => 'skip_invalid',
    ];
    protected const BODY_REQUIRED = false;
}
