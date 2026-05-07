<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Wrap BETH(TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/eth-staking/wbeth/wrap.
 */
class BinancePostSapiV1EthStakingWbethWrap extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_eth_staking_wbeth_wrap';
    protected const DESCRIPTION = 'Wrap BETH(TRADE)

- You need to open Enable Spot & Margin Trading permission for the API Key which requests this endpoint. Weight(IP): 150

Official Binance Spot endpoint: POST /sapi/v1/eth-staking/wbeth/wrap.';
    protected const PARAMETERS = [
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Amount in BETH, limit 4 decimals',
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
    protected const PATH = '/sapi/v1/eth-staking/wbeth/wrap';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
