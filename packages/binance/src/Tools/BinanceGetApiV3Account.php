<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Account Information (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/account.
 */
class BinanceGetApiV3Account extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_account';
    protected const DESCRIPTION = 'Account Information (USER_DATA)

Get current account information. Weight(IP): 20

Official Binance Spot endpoint: GET /api/v3/account.';
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
    protected const PATH = '/api/v3/account';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
