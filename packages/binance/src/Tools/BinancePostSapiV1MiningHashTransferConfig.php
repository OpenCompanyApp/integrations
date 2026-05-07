<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Hashrate Resale Request (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/mining/hash-transfer/config.
 */
class BinancePostSapiV1MiningHashTransferConfig extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_mining_hash_transfer_config';
    protected const DESCRIPTION = 'Hashrate Resale Request (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: POST /sapi/v1/mining/hash-transfer/config.';
    protected const PARAMETERS = [
        'user_name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Mining Account',
        ],
        'algo' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Algorithm(sha256)',
        ],
        'start_date' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Search date, millisecond timestamp, while empty query all',
        ],
        'end_date' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Search date, millisecond timestamp, while empty query all',
        ],
        'to_pool_user' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Mining Account',
        ],
        'hash_rate' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Resale hashrate h/s must be transferred (BTC is greater than 500000000000 ETH is greater than 500000)',
        ],
        'recv_window' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The value cannot be greater than 60000',
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/mining/hash-transfer/config';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'userName' => 'user_name',
        'algo' => 'algo',
        'startDate' => 'start_date',
        'endDate' => 'end_date',
        'toPoolUser' => 'to_pool_user',
        'hashRate' => 'hash_rate',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
