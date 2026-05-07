<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * All Coins' Information (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/capital/config/getall.
 */
class BinanceGetSapiV1CapitalConfigGetall extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_capital_config_getall';
    protected const DESCRIPTION = 'All Coins\' Information (USER_DATA)

Get information of coins (available for deposit and withdraw) for user. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/capital/config/getall.';
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
    protected const PATH = '/sapi/v1/capital/config/getall';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
