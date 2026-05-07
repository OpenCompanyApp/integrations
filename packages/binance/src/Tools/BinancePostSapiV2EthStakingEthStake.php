<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Subscribe ETH Staking V2(TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v2/eth-staking/eth/stake.
 */
class BinancePostSapiV2EthStakingEthStake extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v2_eth_staking_eth_stake';
    protected const DESCRIPTION = 'Subscribe ETH Staking V2(TRADE)

Stake ETH to get WBETH - You need to open Enable Spot & Margin Trading permission for the API Key which requests this endpoint. Weight(IP): 150

Official Binance Spot endpoint: POST /sapi/v2/eth-staking/eth/stake.';
    protected const PARAMETERS = [
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Amount in ETH, limit 4 decimals',
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
    protected const PATH = '/sapi/v2/eth-staking/eth/stake';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
