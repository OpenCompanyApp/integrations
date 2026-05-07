<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Pairs Listings Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v4/dex/spot-pairs/latest.
 */
class CoinMarketCapGetV4DexSpotPairsLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v4_dex_spot_pairs_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/spot-pairs/latest.';
    protected const PARAMETERS = [
        'network_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated CoinMarketCap cryptocurrency network ids.',
        ],
        'network_slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively, one or more comma-separated network names in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens). At least one id or slug is required.',
        ],
        'dex_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated CoinMarketCap dex exchange ids',
        ],
        'dex_slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively, one or more comma-separated dex exchange names in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens). At least one id or slug is required.',
        ],
        'base_asset_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated CoinMarketCap cryptocurrency ids.',
        ],
        'base_asset_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively, one or more comma-separated network symbol in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens).At least one id or slug is required.',
        ],
        'base_asset_contract_address' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively, one base asset contract address in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens).At least one id or slug is required.',
        ],
        'base_asset_ucid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs.',
        ],
        'quote_asset_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated CoinMarketCap cryptocurrency ids.',
        ],
        'quote_asset_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively, one or more comma-separated network symbol in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens). At least one id or slug is required.',
        ],
        'quote_asset_contract_address' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively, one quote asset contract address in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens). At least one id or slug is required.',
        ],
        'quote_asset_ucid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs.',
        ],
        'scroll_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'After your initial query, the API responds with the initial set of results and a scroll_ids. To retrieve the next set of results, provide this scroll_id of the last JSON with your follow-up request. scroll_id is an alternative to traditional pagination techniques.',
        ],
        'limit' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify the number of results to return. Use this parameter and the start parameter to determine your own pagination size.',
        ],
        'liquidity_min' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a threshold of minimum liquidity to filter results by.',
        ],
        'liquidity_max' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a threshold of maximum liquidity to filter results by.',
        ],
        'volume_24h_min' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a threshold of minimum 24 hour USD volume to filter results by.',
        ],
        'volume_24h_max' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a threshold of maximum 24 hour USD volume to filter results by.',
        ],
        'no_of_transactions_24h_min' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a threshold of minimum 24h no. of transactions to filter results by.',
        ],
        'no_of_transactions_24h_max' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a threshold of maximum 24h no. of transactions to filter results by.',
        ],
        'percent_change_24h_min' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a threshold of minimum 24 hour percent change to filter results by.',
        ],
        'percent_change_24h_max' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a threshold of maximum 24 hour percent change to filter results by.',
        ],
        'sort' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`"volume_24h"`
Valid values:  `"volume_24h"` `"liquidity"` `"no_of_transactions_24h"` `"percent_change_24h"` // todo
Sort the list of dex spot pairs by.',
        ],
        'sort_dir' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`"desc"`
Valid values: `"desc"` `"asc"`
The direction in which to order dex spot pairs against the specified sort.',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`""`
Valid values: `"pool_created"` `"percent_pooled_base_asset"` `"num_transactions_24h"` `"pool_base_asset"` `"pool_quote_asset"` `"24h_volume_quote_asset"` `"total_supply_quote_asset"` `"total_supply_base_asset"` `"holders"` `"buy_tax"` `"sell_tax"` `"security_scan"` `"24h_no_of_buys"` `"24h_no_of_sells"` `"24h_buy_volume"` `"24h_sell_volume"`
Optionally specify a comma-separated list of supplemental data fields to return.',
        ],
        'reverse_order' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pass true to invert the order of a spot pair. For example, a trading pair is set up as Token B/Token A in the contract and is commonly referred to as Token A/Token B. Using reverse_order would change the order to reflect the true Token B/Token A pairing as it exists in the pool.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to convert outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when convert is used.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v4/dex/spot-pairs/latest';
    protected const QUERY_PARAMS = [
        'network_id' => 'network_id',
        'network_slug' => 'network_slug',
        'dex_id' => 'dex_id',
        'dex_slug' => 'dex_slug',
        'base_asset_id' => 'base_asset_id',
        'base_asset_symbol' => 'base_asset_symbol',
        'base_asset_contract_address' => 'base_asset_contract_address',
        'base_asset_ucid' => 'base_asset_ucid',
        'quote_asset_id' => 'quote_asset_id',
        'quote_asset_symbol' => 'quote_asset_symbol',
        'quote_asset_contract_address' => 'quote_asset_contract_address',
        'quote_asset_ucid' => 'quote_asset_ucid',
        'scroll_id' => 'scroll_id',
        'limit' => 'limit',
        'liquidity_min' => 'liquidity_min',
        'liquidity_max' => 'liquidity_max',
        'volume_24h_min' => 'volume_24h_min',
        'volume_24h_max' => 'volume_24h_max',
        'no_of_transactions_24h_min' => 'no_of_transactions_24h_min',
        'no_of_transactions_24h_max' => 'no_of_transactions_24h_max',
        'percent_change_24h_min' => 'percent_change_24h_min',
        'percent_change_24h_max' => 'percent_change_24h_max',
        'sort' => 'sort',
        'sort_dir' => 'sort_dir',
        'aux' => 'aux',
        'reverse_order' => 'reverse_order',
        'convert_id' => 'convert_id',
    ];
    protected const BODY_REQUIRED = false;
}
