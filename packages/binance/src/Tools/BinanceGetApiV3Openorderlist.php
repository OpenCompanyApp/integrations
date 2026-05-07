<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Open OCO (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/openOrderList.
 */
class BinanceGetApiV3Openorderlist extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_openorderlist';
    protected const DESCRIPTION = 'Query Open OCO (USER_DATA)

Weight(IP): 6

Official Binance Spot endpoint: GET /api/v3/openOrderList.';
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
    protected const PATH = '/api/v3/openOrderList';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
