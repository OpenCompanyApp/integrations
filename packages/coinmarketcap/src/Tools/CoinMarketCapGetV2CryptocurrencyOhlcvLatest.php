<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * OHLCV Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v2/cryptocurrency/ohlcv/latest.
 */
class CoinMarketCapGetV2CryptocurrencyOhlcvLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v2_cryptocurrency_ohlcv_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/ohlcv/latest.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "symbol" is required.',
        ],
        'convert' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
        ],
        'skip_invalid' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if any invalid cryptocurrencies are requested or a cryptocurrency does not have matching records in the requested timeframe. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v2/cryptocurrency/ohlcv/latest';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'symbol' => 'symbol',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
        'skip_invalid' => 'skip_invalid',
    ];
    protected const BODY_REQUIRED = false;
}
