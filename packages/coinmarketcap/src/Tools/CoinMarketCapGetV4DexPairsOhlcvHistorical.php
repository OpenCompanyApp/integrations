<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * OHLCV Historical.
 *
 * Maps to the official CoinMarketCap endpoint GET /v4/dex/pairs/ohlcv/historical.
 */
class CoinMarketCapGetV4DexPairsOhlcvHistorical extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v4_dex_pairs_ohlcv_historical';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/pairs/ohlcv/historical.';
    protected const PARAMETERS = [
        'contract_address' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One contract address. Example:"0x88e6a0c2ddd26feeb64f039a2c41296fcb3f5640".
If network/dex/base asset/quote asset information is passed, contract address cannot be passed.
Note: contract_address is case sensitive for all non-EVM chains and not case sensitive for all EVM chains. EVM chains contract address addresses begin with 0x, and are followed by 40 alphanumeric characters(numerals and letters)',
        ],
        'network_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more CoinMarketCap cryptocurrency network ids',
        ],
        'network_slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively, one network names in URL friendly shorthand "slug" format (all lowercase, spaces replaced with hyphens).',
        ],
        'time_period' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`"daily"`
Valid values: `"daily"` `"hourly"` `"1m"` `"5m"` `"15m"` `"4h"`
Time period to return OHLCV data for. If hourly, the open will be 01:00 and the close will be 01:59. If daily, the open will be 00:00:00 for the day and close will be 23:59:99 for the same day. See the main endpoint description for details.',
        ],
        'time_start' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Timestamp (Unix or ISO 8601) to start returning OHLCV time periods for. Only the date portion of the timestamp
is used for daily OHLCV so it\'s recommended to send an ISO date format like "2018-09-19" without time.',
        ],
        'time_end' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Timestamp (Unix or ISO 8601) to stop returning OHLCV time periods for (inclusive). Optional, if not passed we\'ll default
to the current time. Only the date portion of the timestamp is used for daily OHLCV so it\'s recommended to send an
ISO date format like "2018-09-19" without time.',
        ],
        'count' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally limit the number of time periods to return results for. The default is 10 items. The current query
limit is 500 items.',
        ],
        'interval' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`"daily"`
Valid values: `"1m"` `"5m"` `"15m"` `"30m"` `"1h"` `"4h"` `"8h"` `"12h"` `"daily"` `"weekly"` `"monthly"`
Optionally adjust the interval that "time_period" is sampled. For example with interval=monthly&time_period=daily you will see a daily OHLCV record for January, February, March and so on. See main endpoint description for available options.',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`""`
Valid values: `"pool_created"` `"percent_pooled_base_asset"` `"num_transactions_24h"` `"pool_base_asset"` `"pool_quote_asset"` `"24h_volume_quote_asset"` `"total_supply_quote_asset"` `"total_supply_base_asset"` `"holders"` `"buy_tax"` `"sell_tax"` `"security_scan"` `"24h_no_of_buys"` `"24h_no_of_sells"` `"24h_buy_volume"` `"24h_sell_volume"`
Optionally specify a comma-separated list of supplemental data fields to return.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to convert outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when convert is used.',
        ],
        'skip_invalid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pass true to relax request validation rules. When requesting records on multiple spot pairs an error is returned if no match is found for 1 or more requested spot pairs. If set to true, invalid lookups will be skipped allowing valid spot pairs to still be returned.',
        ],
        'reverse_order' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pass true to invert the order of a spot pair. For example, a trading pair is set up as Token B/Token A in the contract and is commonly referred to as Token A/Token B. Using reverse_order would change the order to reflect the true Token B/Token A pairing as it exists in the pool.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v4/dex/pairs/ohlcv/historical';
    protected const QUERY_PARAMS = [
        'contract_address' => 'contract_address',
        'network_id' => 'network_id',
        'network_slug' => 'network_slug',
        'time_period' => 'time_period',
        'time_start' => 'time_start',
        'time_end' => 'time_end',
        'count' => 'count',
        'interval' => 'interval',
        'aux' => 'aux',
        'convert_id' => 'convert_id',
        'skip_invalid' => 'skip_invalid',
        'reverse_order' => 'reverse_order',
    ];
    protected const BODY_REQUIRED = false;
}
