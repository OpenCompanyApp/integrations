<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Price Conversion v1 (deprecated).
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/tools/price-conversion.
 */
class CoinMarketCapGetV1ToolsPriceConversion extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_tools_price_conversion';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/tools/price-conversion.';
    protected const PARAMETERS = [
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'An amount of currency to convert. Example: 10.43',
        ],
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The CoinMarketCap currency ID of the base cryptocurrency or fiat to convert from. Example: "1"',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively the currency symbol of the base cryptocurrency or fiat to convert from. Example: "BTC". One "id" *or* "symbol" is required. Please note that starting in the v2 endpoint, due to the fact that a symbol is not unique, if you request by symbol each quote response will contain an array of objects containing all of the coins that use each requested symbol. The v1 endpoint will still return a single object, the highest ranked coin using that symbol.',
        ],
        'time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional timestamp (Unix or ISO 8601) to reference historical pricing during conversion. If not passed, the current time will be used. If passed, we\'ll reference the closest historic values available for this conversion.',
        ],
        'convert' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pass up to 120 comma-separated fiat or cryptocurrency symbols to convert the source amount to.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/tools/price-conversion';
    protected const QUERY_PARAMS = [
        'amount' => 'amount',
        'id' => 'id',
        'symbol' => 'symbol',
        'time' => 'time',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
    ];
    protected const BODY_REQUIRED = false;
}
