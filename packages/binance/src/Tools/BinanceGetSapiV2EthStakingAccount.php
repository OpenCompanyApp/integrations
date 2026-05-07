<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * ETH Staking account V2(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v2/eth-staking/account.
 */
class BinanceGetSapiV2EthStakingAccount extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v2_eth_staking_account';
    protected const DESCRIPTION = 'ETH Staking account V2(USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v2/eth-staking/account.';
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
    protected const PATH = '/sapi/v2/eth-staking/account';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
