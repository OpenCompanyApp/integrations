<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get current ETH staking quota (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/eth-staking/eth/quota.
 */
class BinanceGetSapiV1EthStakingEthQuota extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_eth_staking_eth_quota';
    protected const DESCRIPTION = 'Get current ETH staking quota (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/eth-staking/eth/quota.';
    protected const PARAMETERS = [
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
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/eth-staking/eth/quota';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
