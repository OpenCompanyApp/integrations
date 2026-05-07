<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * OHLCV Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v4/dex/pairs/ohlcv/latest.
 */
class CoinMarketCapGetV4DexPairsOhlcvLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v4_dex_pairs_ohlcv_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/pairs/ohlcv/latest.';
    protected const PARAMETERS = [
        'contract_address' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated contract addresses.',
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
    protected const PATH = '/v4/dex/pairs/ohlcv/latest';
    protected const QUERY_PARAMS = [
        'contract_address' => 'contract_address',
        'network_id' => 'network_id',
        'network_slug' => 'network_slug',
        'aux' => 'aux',
        'convert_id' => 'convert_id',
        'skip_invalid' => 'skip_invalid',
        'reverse_order' => 'reverse_order',
    ];
    protected const BODY_REQUIRED = false;
}
