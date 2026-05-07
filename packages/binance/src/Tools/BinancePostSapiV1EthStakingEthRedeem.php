<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Redeem ETH (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/eth-staking/eth/redeem.
 */
class BinancePostSapiV1EthStakingEthRedeem extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_eth_staking_eth_redeem';
    protected const DESCRIPTION = 'Redeem ETH (TRADE)

Redeem WBETH or BETH and get ETH - You need to open Enable Spot & Margin Trading permission for the API Key which requests this endpoint. Weight(IP): 150

Official Binance Spot endpoint: POST /sapi/v1/eth-staking/eth/redeem.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'WBETH or BETH, default to BETH',
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Amount in BETH, limit 8 decimals',
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
    protected const PATH = '/sapi/v1/eth-staking/eth/redeem';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
