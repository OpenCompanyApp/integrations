<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Subscribe BLVT (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/blvt/subscribe.
 */
class BinancePostSapiV1BlvtSubscribe extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_blvt_subscribe';
    protected const DESCRIPTION = 'Subscribe BLVT (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/blvt/subscribe.';
    protected const PARAMETERS = [
        'token_name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'BTCDOWN, BTCUP',
        ],
        'cost' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Spot balance',
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
    protected const PATH = '/sapi/v1/blvt/subscribe';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'tokenName' => 'token_name',
        'cost' => 'cost',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
