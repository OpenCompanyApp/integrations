<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Futures Lead Trader Status(TRADE).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/copyTrading/futures/userStatus.
 */
class BinanceGetSapiV1CopytradingFuturesUserstatus extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_copytrading_futures_userstatus';
    protected const DESCRIPTION = 'Get Futures Lead Trader Status(TRADE)

Get Futures Lead Trader Status Weight(UID): 20

Official Binance Spot endpoint: GET /sapi/v1/copyTrading/futures/userStatus.';
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
    protected const PATH = '/sapi/v1/copyTrading/futures/userStatus';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
