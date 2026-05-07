<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Max Transfer-Out Amount (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/maxTransferable.
 */
class BinanceGetSapiV1MarginMaxtransferable extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_maxtransferable';
    protected const DESCRIPTION = 'Query Max Transfer-Out Amount (USER_DATA)

- If `isolatedSymbol` is not sent, crossed margin data will be sent. Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/margin/maxTransferable.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
        'isolated_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Isolated symbol',
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
    protected const PATH = '/sapi/v1/margin/maxTransferable';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'isolatedSymbol' => 'isolated_symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
