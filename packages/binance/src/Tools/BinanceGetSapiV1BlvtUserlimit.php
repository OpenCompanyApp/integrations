<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * BLVT User Limit Info (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/blvt/userLimit.
 */
class BinanceGetSapiV1BlvtUserlimit extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_blvt_userlimit';
    protected const DESCRIPTION = 'BLVT User Limit Info (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/blvt/userLimit.';
    protected const PARAMETERS = [
        'token_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'BTCDOWN, BTCUP',
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
    protected const PATH = '/sapi/v1/blvt/userLimit';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'tokenName' => 'token_name',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
