<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query order quantity precision per asset (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/convert/assetInfo.
 */
class BinanceGetSapiV1ConvertAssetinfo extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_convert_assetinfo';
    protected const DESCRIPTION = 'Query order quantity precision per asset (USER_DATA)

Query for supported asset precision information Weight(IP): 100

Official Binance Spot endpoint: GET /sapi/v1/convert/assetInfo.';
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
    protected const PATH = '/sapi/v1/convert/assetInfo';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
