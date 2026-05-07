<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Trades Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v4/dex/pairs/trade/latest.
 */
class CoinMarketCapGetV4DexPairsTradeLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v4_dex_pairs_trade_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/pairs/trade/latest.';
    protected const PARAMETERS = [
        'contract_address' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated contract addresses.',
        ],
        'network_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One CoinMarketCap cryptocurrency network id.',
        ],
        'network_slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively, one network names in URL friendly shorthand "slug"
format (all lowercase, spaces replaced with hyphens).',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`""`
Valid values: `"transaction_hash"` `"blockchain_explorer_link"`
Optionally specify a comma-separated list of supplemental data fields to return.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes in up to 30 currencies at once by passing a comma-separated list of cryptocurrency
or fiat currency IDs. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found in our API document. Each conversion is returned in its
own "trade" object.',
        ],
        'skip_invalid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pass true to relax request validation rules. When requesting records on multiple spot pairs an error is returned
if no match is found for 1 or more requested spot pairs. If set to true, invalid lookups will be skipped allowing valid
spot pairs to still be returned.',
        ],
        'reverse_order' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pass true to invert the order of a spot pair. For example, a trading pair is set up as Token B/Token A in the contract and
is commonly referred to as Token A/Token B. Using reverse_order would change the order to reflect the true
Token B/Token A pairing as it exists in the pool.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v4/dex/pairs/trade/latest';
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
