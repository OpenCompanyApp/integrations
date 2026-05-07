<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Isolated Margin Account Info (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/isolated/account.
 */
class BinanceGetSapiV1MarginIsolatedAccount extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_isolated_account';
    protected const DESCRIPTION = 'Query Isolated Margin Account Info (USER_DATA)

- If "symbols" is not sent, all isolated assets will be returned. - If "symbols" is sent, only the isolated assets of the sent symbols will be returned. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/isolated/account.';
    protected const PARAMETERS = [
        'symbols' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Max 5 symbols can be sent; separated by \',\'',
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
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/margin/isolated/account';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbols' => 'symbols',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
