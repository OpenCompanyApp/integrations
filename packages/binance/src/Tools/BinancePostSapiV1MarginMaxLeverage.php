<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Adjust cross margin max leverage (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/margin/max-leverage.
 */
class BinancePostSapiV1MarginMaxLeverage extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_margin_max_leverage';
    protected const DESCRIPTION = 'Adjust cross margin max leverage (USER_DATA)

Adjust cross margin max leverage Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/margin/max-leverage.';
    protected const PARAMETERS = [
        'max_leverage' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'Can only adjust 3 or 5',
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
    protected const PATH = '/sapi/v1/margin/max-leverage';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'maxLeverage' => 'max_leverage',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
