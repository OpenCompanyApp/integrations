<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Statistics Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/blockchain/statistics/latest.
 */
class CoinMarketCapGetV1BlockchainStatisticsLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_blockchain_statistics_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/blockchain/statistics/latest.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs to return blockchain data for. Pass `1,2,1027` to request all currently supported blockchains.',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Pass `BTC,LTC,ETH` to request all currently supported blockchains.',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Pass `bitcoin,litecoin,ethereum` to request all currently supported blockchains.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/blockchain/statistics/latest';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'symbol' => 'symbol',
        'slug' => 'slug',
    ];
    protected const BODY_REQUIRED = false;
}
